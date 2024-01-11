<?php

namespace App\Http\Controllers;

use App\Models\Asset;
use App\Http\Requests\StoreAssetRequest;
use App\Http\Requests\UpdateAssetRequest;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

use Exception;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Excel as ExcelType;
use Maatwebsite\Excel\Facades\Excel;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class AssetExport implements FromQuery, WithHeadings, WithMapping
{
    use Exportable;
    private string $category;

    public function __construct(string $category)
    {
        $this->category = $category;
    }

    public function query()
    {
        return Asset::query()
            ->when(
                $this->category,
                function ($query, $category) {
                    if ($category === 'All')
                        return $query;
                    return $query->where('category', $category);
                }
            );
    }


    public function map($asset): array
    {
        return [
            $asset->id,
            $asset->name,
            $asset->description,
            $asset->category,
            $asset->price,
            $asset->stock,
            $asset->created_at,
            $asset->updated_at,
        ];
    }

    public function headings(): array
    {
        return [
            'ID',
            'Name',
            'Description',
            'Category',
            'Price',
            'Stock',
            'Created At',
            'Updated At',
        ];
    }
}

class AssetController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        $assets = Asset::query()
            ->when(
                $request->query('category'),
                function ($query, $category) {
                    if ($category === 'All')
                        return $query;
                    return $query->where('category', $category);
                }
            )
            ->latest()
            ->paginate(10);

        return view('assets.index', compact('assets'));
    }

    /**
     * Export a listing of the resource.
     */
    public function export(Request $request)
    {
        $category = $request->query('category') ?? 'All';
        return Excel::download(new AssetExport($category), 'assets.csv', ExcelType::CSV);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        return view('assets.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreAssetRequest $request): RedirectResponse
    {
        $asset = Asset::create($request->validated());

        return redirect()
            ->route('assets.index')
            ->with('success', sprintf('Asset %s has been created.', $asset->name));
    }

    /**
     * Display the specified resource.
     */
    public function show(Asset $asset): View
    {
        return view('assets.show', compact('asset'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Asset $asset): View
    {
        return view('assets.edit', compact('asset'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateAssetRequest $request, Asset $asset): RedirectResponse
    {
        $asset->update($request->validated());

        return redirect()
            ->route('assets.index')
            ->with('success', sprintf('Asset %s has been updated.', $asset->name));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Asset $asset)
    {
        $asset->delete();

        return redirect()
            ->route('assets.index')
            ->with('success', sprintf('Asset %s has been deleted.', $asset->name));
    }
}

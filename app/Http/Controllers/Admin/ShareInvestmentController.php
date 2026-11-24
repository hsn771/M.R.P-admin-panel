<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ShareInvestment;
use Illuminate\Http\Request;

class ShareInvestmentController extends Controller
{
    private const FILE_FIELDS = ['customer_photo', 'nominee_photo', 'digital_sign'];

    public function index(Request $request)
    {
        $query = ShareInvestment::query();

        if ($request->filled('search')) {
            $term = trim($request->search);
            $id = (int) preg_replace('/\D/', '', $term);
            $query->where(function ($q) use ($term, $id) {
                $q->where('customer_name', 'like', "%{$term}%")
                    ->orWhere('customer_phone', 'like', "%{$term}%");
                if ($id > 0) {
                    $q->orWhere('id', $id);
                }
            });
        }

        $shareInvestments = $query->latest()->paginate(10);
        return view('admin.share_investments.index', compact('shareInvestments'));
    }

    public function show(ShareInvestment $shareInvestment)
    {
        return view('admin.share_investments.show', compact('shareInvestment'));
    }

    public function destroy(ShareInvestment $shareInvestment)
    {
        foreach (self::FILE_FIELDS as $field) {
            if ($shareInvestment->{$field} && ($path = $this->resolvePath(basename($shareInvestment->{$field})))) {
                unlink($path);
            }
        }

        $shareInvestment->delete();

        return redirect()->route('admin.share-investments.index')
            ->with('success', 'Share investment application deleted successfully');
    }

    public function viewFile($filename)
    {
        $path = $this->resolvePath(basename($filename));

        if (!$path) {
            abort(404);
        }

        if (request()->has('download')) {
            return response()->download($path);
        }

        return response()->file($path);
    }

    private function resolvePath(string $filename): ?string
    {
        foreach ([
            storage_path('app/public/share-investments/' . $filename),
            public_path('storage/share-investments/' . $filename),
        ] as $path) {
            if (file_exists($path)) {
                return $path;
            }
        }

        return null;
    }
}

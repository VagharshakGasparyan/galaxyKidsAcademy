<?php

namespace App\Http\Controllers;

use App\Models\Deal;
use App\Models\Page;
use App\Services\FService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AdminDealsController extends Controller
{
    public array $statuses;

    public function __construct()
    {
        $this->statuses = [
            Deal::STATUS_PENDING => 'Pending',
            Deal::STATUS_VIEWED => 'Viewed',
            Deal::STATUS_APPROVED => 'Approved',
            Deal::STATUS_DENY  => 'Deny',
            Deal::STATUS_ARCHIVED => 'Archived',
        ];
    }

    public function index(Request $request)
    {
        $first_name = $request->query('first_name');
        $last_name = $request->query('last_name');
        $status = $request->query('status');

        $deals = Deal::when($first_name, function ($query) use ($first_name) {
            return $query->where('first_name', 'like', '%' . $first_name . '%');
        })
            ->when($last_name, function ($query) use ($last_name) {
                return $query->where('last_name', 'like', '%' . $last_name . '%');
            })
            ->when($status, function ($query) use ($status) {
                return $query->where('status', $status);
            })
            ->orderBy('created_at', 'desc')->paginate(10);

        $statuses = $this->statuses;

        return view('admin.deal.deals', compact('deals', 'first_name', 'last_name', 'status', 'statuses'));
    }

    public function update($id): \Illuminate\Contracts\View\View
    {
        $deal = Deal::findOrFail($id);
        $statuses = $this->statuses;
        return view('admin.deal.update_deal', compact('deal', 'statuses'));
    }

    public function postUpdate(Request $request, $id)
    {
//        dd($request->all());
        $deal = Deal::findOrFail($id);
        request()->validate([
            'first_name' => 'required|min:2',
            'last_name' => 'required|min:2',
            'email' => 'required|email|min:6|unique:deals,email,' . $id,
            'phone_number' => 'required|min:9',
            'comments' => 'required|min:10|max:500',
            'status' => 'required|in:' . Deal::STATUS_PENDING . ',' . Deal::STATUS_VIEWED . ','
                . Deal::STATUS_APPROVED . ',' . Deal::STATUS_DENY . ',' . Deal::STATUS_ARCHIVED,
        ]);

        $deal->update([
            'first_name' => $request->get('first_name'),
            'last_name' => $request->get('last_name'),
            'email' => $request->get('email'),
            'phone_number' => $request->get('phone_number'),
            'comments' => $request->get('comments'),
            'status' => $request->get('status'),
        ]);

        return back();
    }

    public function show(Request $request, $id): \Illuminate\Contracts\View\View
    {
        $deal = Deal::findOrFail($id);
        return view('admin.deal.show_deal', compact('deal'));
    }

    public function delete($id): \Illuminate\Http\RedirectResponse
    {
        /**
         * hint
         * Page::where('id', $id)->delete() not working for delete files
         * use age::find($id)->delete();
         */
        if (Deal::where('id', $id)->exists()) {
            Deal::find($id)->delete();
        }

        return back();
    }
}

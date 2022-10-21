<?php

namespace App\Http\Controllers\Admin;

use App\Models\Partnership;
use App\Models\PartnershipItem;
use App\Http\Controllers\Controller;
use App\Http\Requests\StorePartnershipRequest;
use App\Http\Requests\UpdatePartnershipRequest;
use App\Http\Requests\StorePartnershipItemRequest;
use App\Http\Requests\UpdatePartnershipItemRequest;

class PartnershipItemController extends Controller
{

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Partnership $partnership)
    {
        return view('admin.settings.partnership.item.create', compact('partnership'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StorePartnershipRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePartnershipItemRequest $request, Partnership $partnership)
    {
        $data = $request->validated();
        $data['partnership_id'] = $partnership->id;
        PartnershipItem::create($data);
        return redirect()->route('admin.settings.partnership.index');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Partnership  $partnership
     * @return \Illuminate\Http\Response
     */
    public function edit(Partnership $partnership, $partnershipItem)
    {
        $partnershipItem = PartnershipItem::find($partnershipItem);
        return view('admin.settings.partnership.item.edit', compact('partnership', 'partnershipItem'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdatePartnershipRequest  $request
     * @param  \App\Models\Partnership  $partnership
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatePartnershipItemRequest $request, Partnership $partnership, $partnershipItem)
    {
        PartnershipItem::find($partnershipItem)->update($request->validated());
        return redirect()->route('admin.settings.partnership.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Partnership  $partnership
     * @return \Illuminate\Http\Response
     */
    public function destroy(Partnership $partnership, $partnershipItem)
    {
        PartnershipItem::find($partnershipItem)->delete();
        return redirect()->route('admin.settings.partnership.index');
    }
}

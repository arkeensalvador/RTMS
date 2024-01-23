<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\StratProgramListImg;
use App\Models\StratCollabImg;
use App\Models\StratTechListImg;
use App\Models\TrainingsImg;
use App\Models\EquipmentImg;

class DropzoneController extends Controller
{
    public function fileStore(Request $request)
    {
        $image = $request->file('file');
        $imageName = $image->getClientOriginalName();
        $image->move(public_path('strategic_imgs'), $imageName);

        $imageUpload = new StratProgramListImg();
        $imageUpload->filename = 'strategic_imgs/' . $imageName;
        $imageUpload->strategic_programs_list_id = $request->strategic_programs_list_id;
        $imageUpload->save();
        return response()->json(['success' => $imageName]);
    }

    public function fileStoreCollab(Request $request)
    {
        $image = $request->file('file');
        $imageName = $image->getClientOriginalName();
        $image->move(public_path('strategic_collab_imgs'), $imageName);

        $imageUpload = new StratCollabImg();
        $imageUpload->filename = 'strategic_collab_imgs/' . $imageName;
        $imageUpload->strategic_collab_id = $request->str_p_id;
        $imageUpload->save();

        return response()->json(['success' => $imageName]);
    }

    public function fileStoreTech(Request $request)
    {
        $image = $request->file('file');
        $imageName = $image->getClientOriginalName();
        $image->move(public_path('strategic_tech_imgs'), $imageName);

        $imageUpload = new StratTechListImg();
        $imageUpload->filename = 'strategic_tech_imgs/' . $imageName;
        $imageUpload->strategic_tech_id = $request->strategic_tech_id;
        $imageUpload->save();

        return response()->json(['success' => $imageName]);
    }

    public function fileStoreTraining(Request $request)
    {
        $image = $request->file('file');
        $imageName = $image->getClientOriginalName();
        $image->move(public_path('training_imgs'), $imageName);

        $imageUpload = new TrainingsImg();
        $imageUpload->filename = 'training_imgs/' . $imageName;
        $imageUpload->training_id = $request->training_id;
        $imageUpload->save();

        return response()->json(['success' => $imageName]);
    }

    public function fileStoreEquipment(Request $request)
    {
        $image = $request->file('file');
        $imageName = $image->getClientOriginalName();
        $image->move(public_path('equipment_imgs'), $imageName);

        $imageUpload = new EquipmentImg();
        $imageUpload->filename = 'equipment_imgs/' . $imageName;
        $imageUpload->equipment_id = $request->equipment_id;
        $imageUpload->save();

        return response()->json(['success' => $imageName]);
    }
}

<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\StratTechListImg;
use App\Models\StratCollabImg;
use App\Models\StratProgramListImg;
use App\Models\TrainingsImg;
use App\Models\EquipmentImg;

class ImageController extends Controller
{
    //
    public function deleteImg($id)
    {
        // Find the image by its ID
        $image = StratTechListImg::findOrFail($id);

        // Delete the file from the directory
        $filePath = public_path($image->filename);
        if (file_exists($filePath)) {
            unlink($filePath);
        }

        // Delete the record from the database
        $image->delete();

        // Optionally, you can redirect the user back or return a success response
        return redirect()->back()->with('success', 'Image deleted successfully');
    }

    public function deleteCollabImg($id)
    {
        // Find the image by its ID
        $image = StratCollabImg::findOrFail($id);

        // Delete the file from the directory
        $filePath = public_path($image->filename);
        if (file_exists($filePath)) {
            unlink($filePath);
        }

        // Delete the record from the database
        $image->delete();

        // Optionally, you can redirect the user back or return a success response
        return redirect()->back()->with('success', 'Image deleted successfully');
    }

    public function deleteProgListImg($id)
    {
        // Find the image by its ID
        $image = StratProgramListImg::findOrFail($id);

        // Delete the file from the directory
        $filePath = public_path($image->filename);
        if (file_exists($filePath)) {
            unlink($filePath);
        }

        // Delete the record from the database
        $image->delete();

        // Optionally, you can redirect the user back or return a success response
        return redirect()->back()->with('success', 'Image deleted successfully');
    }

    public function deleteTrainingImg($id)
    {
        // Find the image by its ID
        $image = TrainingsImg::findOrFail($id);

        // Delete the file from the directory
        $filePath = public_path($image->filename);
        if (file_exists($filePath)) {
            unlink($filePath);
        }

        // Delete the record from the database
        $image->delete();

        // Optionally, you can redirect the user back or return a success response
        return redirect()->back()->with('success', 'Image deleted successfully');
    }

    public function deleteEquipImg($id)
    {
        // Find the image by its ID
        $image = EquipmentImg::findOrFail($id);

        // Delete the file from the directory
        $filePath = public_path($image->filename);
        if (file_exists($filePath)) {
            unlink($filePath);
        }

        // Delete the record from the database
        $image->delete();

        // Optionally, you can redirect the user back or return a success response
        return redirect()->back()->with('success', 'Image deleted successfully');
    }
}

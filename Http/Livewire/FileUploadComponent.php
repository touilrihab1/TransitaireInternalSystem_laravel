<?php

namespace App\Http\Livewire;

use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Crypt;
use Livewire\Component;
use App\Models\File;
use App\Http\Controllers\FileUploadController;
use Psy\Readline\Hoa\Console;
use Symfony\Component\HttpFoundation\Request;

class FileUploadComponent extends Component
{
    public $idaze;
    public $departements;

    public $deleteId = '';




    public function deleteId($id)
    {

        $this->deleteId = $id;

    }

    /**
     * Write code on Method
     *
     */
    public function delete()
    {
        //Log::info('An informational message.');
        File::find($this->deleteId)->delete();
        session()->flash('success', 'File deleted successfully ');
    }


    public function render(Request $request)
    {

        $id_crypte = $this->idaze;
        $id_decrypte = decrypt($id_crypte);
        $files = File::where('id_dossier', $id_decrypte)->get();
        return view('livewire.file-upload-component', compact('files'));
    }

    public function getIds(Request $request)
    {
        $fileIds = $request->input('files');
        $ids = [];

        foreach ($fileIds as $fileId) {
            $ids[] = $fileId;
        }


    }



}

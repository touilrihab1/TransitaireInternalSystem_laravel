<?php

namespace App\Http\Livewire;

use App\Models\Article;
use App\Models\Client;
use App\Models\origin;
use Livewire\Component;

class InputClient extends Component
{
    public $inputName = "";
    public $search = "";
    public $search_March = "";
    public $search_Dest = "";
    public $search_D = "";
    public $records;
    public $records_March;
    public $records_Dest;
    public $records_D;

    public $showdiv = false;
    public $showdiv_March = false;
    public $showdiv_Dest = false;
    public $showdiv_D = false;

    public function searchClient()
    {
        if (!empty($this->search)) {
            $this->records = Client::orderby('Raison_Sociale', 'asc')
                ->select('*')
                ->where('Raison_Sociale', 'like', $this->search . '%')
                ->limit(5)
                ->get();

            $this->showdiv = true;
        } else {
            $this->showdiv = false;
        }
    }
    public function searchMarch()
    {
        if (!empty($this->search_March)) {
            $this->records_March = Article::orderby('Designation_Article', 'asc')
                ->select('*')
                ->where('Designation_Article', 'like', $this->search_March . '%')
                ->limit(5)
                ->get();

            $this->showdiv_March = true;
        } else {
            $this->showdiv_March = false;
        }
    }

    public function fetchMarchDetail($id = 0)
    {

        $record = Article::select('*')
            ->where('Id_Article', $id)
            ->first();

        $this->search_March = $record->Designation_Article;
        $this->showdiv_March = false;
    }
    public function fetchClinetDetail($id = 0)
    {

        $record = Client::select('*')
            ->where('Id', $id)
            ->first();

        $this->search = $record->Raison_Sociale;
        $this->showdiv = false;
    }
    //--------------------------------------------------------//

    // public function searchMarch()
    // {
    //     if (!empty($this->search_March)) {
    //         $this->records_March = Article::orderby('Designation_Article', 'asc')
    //             ->select('*')
    //             ->where('Designation_Article', 'like', $this->search_March . '%')
    //             ->limit(5)
    //             ->get();

    //         $this->showdiv_March = true;
    //     } else {
    //         $this->showdiv_March = false;
    //     }
    // }
    public function searchDest()
    {
        if (!empty($this->search_Dest)) {
            $this->records_Dest = origin::orderby('Intitule_Origine', 'asc')
                ->select('*')
                ->where('Intitule_Origine', 'like', $this->search_Dest . '%')
                ->limit(5)
                ->get();

            $this->showdiv_Dest = true;
        } else {
            $this->showdiv_Dest = false;
        }
    }
    public function fetchDestDetail($id = 0)
    {

        $record = origin::select('*')
            ->where('Id_Origine', $id)
            ->first();

        $this->search_Dest = $record->Intitule_Origine;
        $this->showdiv_Dest = false;
    }
    public function render()
    {
        return view('livewire.input-client');
    }


    public function searchD()
    {
        if (!empty($this->search_D)) {
            $this->records_D = Client::orderby('Raison_Sociale', 'asc')
                ->select('*')
                ->where('Raison_Sociale', 'like', $this->search_D . '%')
                ->limit(5)
                ->get();

            $this->showdiv_D = true;
        } else {
            $this->showdiv_D = false;
        }
    }
    public function fetchDDetail($id = 0)
    {

        $record = Client::select('*')
            ->where('Id', $id)
            ->first();

        $this->search_D = $record->Raison_Sociale;
        $this->showdiv_D = false;
    }


}

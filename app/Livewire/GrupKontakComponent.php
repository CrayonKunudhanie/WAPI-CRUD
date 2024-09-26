<?php

namespace App\Livewire;

use App\Models\GrupKontak;
use App\Models\ListKontak;
use Livewire\Component;
use Livewire\WithPagination;
use Symfony\Contracts\Service\Attribute\Required;

class GrupKontakComponent extends Component
{
    use WithPagination;

    protected $paginationTheme = 'simple-tailwind';
    public $nama_grup;
    public $selected_kontak = [];
    public $grup_id;
    public $updatedatagrup = false;
    public $isGrupVisible = false;
    public $isModalGrupOpen = false;

    public function tambahgrup()
    {

        $this->isGrupVisible = true;
        $validatedData = $this->validate([
            'nama_grup' => 'required',
            'selected_kontak' => 'required|array|min:1',
        ]);

        $grup = GrupKontak::create([
            'nama_grup' => $this->nama_grup,
            'jumlah_kontak' => count($this->selected_kontak),
        ]);

        $grup->kontak()->attach($this->selected_kontak);

        $this->refreshgrup();
    }

    private function refreshgrup()
    {
        $this->nama_grup = '';
        $this->selected_kontak = [];
        $this->isGrupVisible = false;
    }

    public function editgrup($id)
    {
        $grup = GrupKontak::find($id);

        if ($grup) {
            $this->grup_id = $grup->id; // Set grup_id properly
            $this->nama_grup = $grup->nama_grup;
            $this->selected_kontak = $grup->kontak->pluck('id')->toArray();
    
            $this->updatedatagrup = true; // Edit mode is active
        } else {
            session()->flash('error', 'Group not found!'); // Error handling
        }
    }


    public function updategrup()
    {
        $this->validate([
            'nama_grup' => 'required|string|max:255',
            'selected_kontak' => 'required|array|min:1',
        ]);

        $grup = GrupKontak::find($this->grup_id);

        if($grup) {
            $grup->update([
            'nama_grup' => $this->nama_grup,
            'jumlah_kontak' => count($this->selected_kontak),
            ]);

            $grup->kontak()->sync($this->selected_kontak);

            $this->resetForm();
            $this->updatedatagrup = false;
        }

    }


    public function confirmdelete($id)
    {
        $this->grup_id = $id;
        $this->isModalGrupOpen = true;
    }

    public function delete($id)
    {
        $grup = GrupKontak::findOrFail($id)->delete();
        $grup->kontak()->detach();
        $grup->delete();
        $this->isModalGrupOpen = false;
    }

    public function gajadi()
    {
        $this->isModalGrupOpen = false;
    }

    public function batal()
    {
        $this->isGrupVisible = false;
    }

    public function render()
    {
        // Ambil data grup dengan paginasi
        $dataGrup = GrupKontak::orderBy('created_at', 'asc')->paginate(5);

        // Ambil semua kontak
        $kontaks = ListKontak::all();

        // Return view dan oper variabel dataGrup dan kontaks ke dalam compact
        return view('livewire.grup-kontak-component', compact('dataGrup', 'kontaks'));
    }
}

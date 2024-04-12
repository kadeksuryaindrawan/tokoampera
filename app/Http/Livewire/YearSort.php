<?php

namespace App\Http\Livewire;

use App\Models\Order;
use Livewire\WithPagination;
use Livewire\Component;

class YearSort extends Component
{
    use WithPagination;

    public $year;

    public function updatedYear($value)
    {
        $januari = Order::whereYear('created_at', $value)->whereMonth('created_at', '01')->where('status', 'diterima')->count();
        $februari = Order::whereYear('created_at', $value)->whereMonth('created_at', '02')->where('status', 'diterima')->count();
        $maret = Order::whereYear('created_at', $value)->whereMonth('created_at', '03')->where('status', 'diterima')->count();
        $april = Order::whereYear('created_at', $value)->whereMonth('created_at', '04')->where('status', 'diterima')->count();
        $mei = Order::whereYear('created_at', $value)->whereMonth('created_at', '05')->where('status', 'diterima')->count();
        $juni = Order::whereYear('created_at', $value)->whereMonth('created_at', '06')->where('status', 'diterima')->count();
        $juli = Order::whereYear('created_at', $value)->whereMonth('created_at', '07')->where('status', 'diterima')->count();
        $agustus = Order::whereYear('created_at', $value)->whereMonth('created_at', '08')->where('status', 'diterima')->count();
        $september = Order::whereYear('created_at', $value)->whereMonth('created_at', '09')->where('status', 'diterima')->count();
        $oktober = Order::whereYear('created_at', $value)->whereMonth('created_at', '10')->where('status', 'diterima')->count();
        $november = Order::whereYear('created_at', $value)->whereMonth('created_at', '11')->where('status', 'diterima')->count();
        $desember = Order::whereYear('created_at', $value)->whereMonth('created_at', '12')->where('status', 'diterima')->count();
        $this->dispatchBrowserEvent('updateChart', [
            'januari' => $januari,
            'februari' => $februari,
            'maret' => $maret,
            'april' => $april,
            'mei' => $mei,
            'juni' => $juni,
            'juli' => $juli,
            'agustus' => $agustus,
            'september' => $september,
            'oktober' => $oktober,
            'november' => $november,
            'desember' => $desember,
        ]);
    }

    public function render()
    {
        $year = $this->year;
        $januari = Order::whereYear('created_at', $year)->whereMonth('created_at', '01')->where('status', 'diterima')->count();
        $februari = Order::whereYear('created_at', $year)->whereMonth('created_at', '02')->where('status', 'diterima')->count();
        $maret = Order::whereYear('created_at', $year)->whereMonth('created_at', '03')->where('status', 'diterima')->count();
        $april = Order::whereYear('created_at', $year)->whereMonth('created_at', '04')->where('status', 'diterima')->count();
        $mei = Order::whereYear('created_at', $year)->whereMonth('created_at', '05')->where('status', 'diterima')->count();
        $juni = Order::whereYear('created_at', $year)->whereMonth('created_at', '06')->where('status', 'diterima')->count();
        $juli = Order::whereYear('created_at', $year)->whereMonth('created_at', '07')->where('status', 'diterima')->count();
        $agustus = Order::whereYear('created_at', $year)->whereMonth('created_at', '08')->where('status', 'diterima')->count();
        $september = Order::whereYear('created_at', $year)->whereMonth('created_at', '09')->where('status', 'diterima')->count();
        $oktober = Order::whereYear('created_at', $year)->whereMonth('created_at', '10')->where('status', 'diterima')->count();
        $november = Order::whereYear('created_at', $year)->whereMonth('created_at', '11')->where('status', 'diterima')->count();
        $desember = Order::whereYear('created_at', $year)->whereMonth('created_at', '12')->where('status', 'diterima')->count();

        return view('livewire.year-sort', compact('januari', 'februari', 'maret', 'april', 'mei', 'juni', 'juli', 'agustus', 'september', 'oktober', 'november', 'desember', 'year'));
    }
}

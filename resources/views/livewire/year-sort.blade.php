<div class="row">
                        <div class="col-lg-12 mb-3">
                            <label for="tahun">Pilih Tahun :</label>
                            <select wire:model="year" wire:change="render" id="tahun" class="form-control">
                                <option value="" disabled>- Pilih Tahun -</option>
                                <option value="2020" @if($year == '2020') selected @endif>2020</option>
                                <option value="2021" @if($year == '2021') selected @endif>2021</option>
                                <option value="2022" @if($year == '2022') selected @endif>2022</option>
                                <option value="2023" @if($year == '2023') selected @endif>2023</option>
                                <option value="2024" @if($year == '2024') selected @endif>2024</option>
                                <option value="2025" @if($year == '2025') selected @endif>2025</option>
                                <option value="2026" @if($year == '2026') selected @endif>2026</option>
                                <option value="2027" @if($year == '2027') selected @endif>2027</option>
                                <option value="2028" @if($year == '2028') selected @endif>2028</option>
                                <option value="2029" @if($year == '2029') selected @endif>2029</option>
                                <option value="2030" @if($year == '2030') selected @endif>2030</option>
                            </select>
                        </div>
                <div class="col-lg-12">
                    <div class="card mb-4">
                        <article class="card-body">
                            <div class="d-flex justify-content-between align-items-center">
                                <div>
                                    <h5 class="card-title">Data Penjualan Tahun {{ $year }}</h5>
                                </div>
                                <div>
                                    <a href="{{ route('export-excel-penjualan-tahun',$year) }}"><button class="btn btn-primary btn-sm">Export Excel Tahun {{ $year }}</button></a>
                                </div>
                            </div>

                            <canvas id="myChart" height="120px"></canvas>
                        </article>
                    </div>
                </div>
</div>

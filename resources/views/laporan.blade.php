<x-app-layout>

    <div class="py-12">
        <div class="max-w-full mx-auto sm:px-2 lg:px-4">
            @if (Session::has('success'))
                <script>
                    alert("{{ Session::get('success') }}");
                </script>
            @endif
            @if (Session::has('error'))
                <script>
                    alert("{{ Session::get('error') }}");
                </script>
            @endif
            <button data-modal-target="defaultModal" data-modal-toggle="defaultModal"
                class="block text-white bg-blue-800 hover:bg-blue-900 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center mb-3 ms-2"
                type="button">
                Tambah Laporan
            </button>

            <div id="defaultModal" tabindex="-1" aria-hidden="true"
                class="fixed top-0 left-0 right-0 z-50 hidden w-full p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] max-h-full">
                <div class="relative w-full max-w-2xl max-h-full">
                    <div class="relative bg-white rounded-xl shadow">
                        <div class="flex bg-blue-800 items-start justify-between p-4 border-b rounded-lg">
                            <h3 class="text-xl font-semibold text-white">
                                Tambah Laporan
                            </h3>
                        </div>
                        <div class="p-6 space-y-6">
                            <form action="{{ route('laporan.store') }}" method="post">
                                @csrf
                                <div class="mb-3">
                                    <label class="block mb-2 text-md font-medium text-black">Tanggal Laporan</label>
                                    <input type="date" name="tanggal" 
                                        value="{{ old('tanggal') }}"
                                        class="bg-white border border-black text-black text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                                        placeholder="Masukan Tanggal" autocomplete="off" required>
                                    @error('tanggal')
                                        <div class="text-red-500 text-sm">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label class="block mb-2 text-md font-medium text-black">Nama Pengurus</label>
                                    <select name="pengurus"
                                        class="bg-white border border-black text-black text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                                        placeholder="Masukan " autocomplete="off" required>
                                        <option disabled selected>Pilih Pengurus</option>
                                        @foreach ($ps as $sel)
                                            <option value="{{ $sel->id }}" {{ old('pengurus') == $sel->id ? 'selected' : '' }}>
                                                {{ $sel->nama_ps }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('pengurus')
                                        <p class="text-red-600 font-medium text-sm ml-2">*{{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label class="block mb-2 text-md font-medium text-black">Nama Supplier</label>
                                    <select name="supplier"
                                        class="bg-white border border-black text-black text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                                        placeholder="Masukan supplier" autocomplete="off" required>
                                        <option disabled selected>Pilih Supplier</option>
                                        @foreach ($s as $sul)
                                            <option value="{{ $sul->id }}" {{ old('supplier') == $sul->id ? 'selected' : '' }}>
                                                {{ $sul->nama_s }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('supplier')
                                        <p class="text-red-600 font-medium text-sm ml-2">*{{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label class="block mb-2 text-md font-medium text-black">Nama Produk</label>
                                    <select name="produk"
                                        class="bg-white border border-black text-black text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                                        placeholder="Masukan Produk" autocomplete="off" required>
                                        <option disabled selected>Pilih Produk</option>
                                        @foreach ($p as $sil)
                                            <option value="{{ $sil->id }}" {{ old('produk') == $sil->id ? 'selected' : '' }}>
                                                {{ $sil->nama_p }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('produk')
                                        <p class="text-red-600 font-medium text-sm ml-2">*{{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label class="block mb-2 text-md font-medium text-black">Laporan</label>
                                    <textarea type="text" name="laporan"
                                        class="bg-white border border-black text-black text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                                        placeholder="Masukan Laporan" autocomplete="off" required>{{ old('laporan') }}</textarea>
                                    @error('laporan')
                                        <p class="text-red-600 font-medium text-sm ml-2">*{{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <button type="submit" name="simpan"
                                        class="text-white bg-blue-800 hover:bg-blue-900 font-medium rounded-lg text-sm w-full px-5 py-2.5">Simpan</button>
                                </div>
                            </form>
                            
                        </div>
                    </div>
                </div>
            </div>
            <div class="relative overflow-x-auto shadow-md rounded-lg">
                <table class="w-full text-sm text-left text-gray-500">
                    <thead class="text-xs text-white uppercase bg-blue-800">
                        <tr>
                            <th scope="col" class="px-6 py-3">
                                #
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Tanggal Melapor
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Nama Pengurus yang melapor
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Nomor hp pelapor
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Email pelapor
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Nama Supplier yang dilaporkan
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Nomor hp yang dilaporkan
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Email yang dilaporkan
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Pada saat melakukan transaksi
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Laporan
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Aksi
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($data as $isi)
                            <tr class="bg-white border-b">
                                <th scope="row" class="px-6 py-4 font-medium text-black whitespace-nowrap">
                                    {{ $loop->iteration }}
                                </th>
                                <td class="px-6 py-4">
                                    {{ $isi->tanggal_l }}
                                </td>
                                <td class="px-6 py-4">
                                    {{ $isi->pengurus->nama_ps }}
                                </td>
                                <td class="px-6 py-4">
                                    {{ $isi->pengurus->no_hp_peng }}
                                </td>
                                <td class="px-6 py-4">
                                    {{ $isi->pengurus->email_ps }}
                                </td>
                                <td class="px-6 py-4">
                                    {{ $isi->supplier->nama_s }}
                                </td>
                                <td class="px-6 py-4">
                                    {{ $isi->supplier->no_hp_sup }}
                                </td>
                                <td class="px-6 py-4">
                                    {{ $isi->supplier->email_s }}
                                </td>
                                <td class="px-6 py-4">
                                    {{ $isi->produk->nama_p }}
                                </td>
                                <td class="px-6 py-4">
                                    {{ $isi->laporan }}
                                </td>
                                <td class="px-6 py-4">
                                    <button data-modal-target="modal{{ $isi->id }}"
                                        data-modal-toggle="modal{{ $isi->id }}"
                                        class="text-blue-600 text-sm font-medium mr-3 type=" button">
                                        Edit
                                    </button>
                                    <div id="modal{{ $isi->id }}" tabindex="-1" aria-hidden="true"
                                        class="fixed top-0 left-0 right-0 z-50 hidden w-full p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] max-h-full">
                                        <div class="relative w-full max-w-2xl max-h-full">
                                            <div class="relative bg-white rounded-xl shadow">
                                                <div
                                                    class="flex bg-blue-800 items-start justify-between p-4 border-b rounded-lg">
                                                    <h3 class="text-xl font-semibold text-white">
                                                        Edit
                                                    </h3>
                                                </div>
                                                <div class="p-6 space-y-6">
                                                    <form action="{{ route('laporan.update', ['id' => $isi->id]) }}"
                                                        method="post">
                                                        @method('PUT')
                                                        @csrf
                                                        <div class="mb-3">
                                                            <label
                                                                class="block mb-2 text-md font-medium text-black">Tanggal
                                                                Laporan</label>
                                                            <input type="date" name="tanggal"
                                                                value="{{ $isi->tanggal_l }}"
                                                                class="bg-white border border-black text-black text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                                                                placeholder="Masukan Tanggal" autocomplete="off" required>
                                                            @error('tanggal')
                                                                <div class="text-red-500 text-sm">{{ $message }}
                                                                </div>
                                                            @enderror
                                                        </div>
                                                        <div class="mb-3">
                                                            <label
                                                                class="block mb-2 text-md font-medium text-black">Nama
                                                                Pengurus</label>
                                                            <select name="pengurus"
                                                                class="bg-white border border-black text-black text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                                                                placeholder="Masukan " autocomplete="off" required>
                                                                <option disabled selected>Pilih Pengurus</option>
                                                                @foreach ($ps as $sel)
                                                                    <option
                                                                        value="{{ $sel->id }}"{{ $sel->id == $isi->id_pengurus ? 'selected' : '' }}>
                                                                        {{ $sel->nama_ps }}
                                                                    </option>
                                                                @endforeach
                                                            </select>
                                                            @error('pengurus')
                                                                <p class="text-red-600 font-medium text-sm ml-2">
                                                                    *{{ $message }}</p>
                                                            @enderror
                                                        </div>
                                                        <div class="mb-3">
                                                            <label
                                                                class="block mb-2 text-md font-medium text-black">Nama
                                                                Supplier</label>
                                                            <select name="supplier"
                                                                class="bg-white border border-black text-black text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                                                                placeholder="Masukan supplier" autocomplete="off" required>
                                                                <option disabled selected>Pilih Supplier</option>
                                                                @foreach ($s as $sul)
                                                                    <option
                                                                        value="{{ $sul->id }}"{{ $sul->id == $isi->id_supplier ? 'selected' : '' }}>
                                                                        {{ $sul->nama_s }}
                                                                    </option>
                                                                @endforeach
                                                            </select>
                                                            @error('supplier')
                                                                <p class="text-red-600 font-medium text-sm ml-2">
                                                                    *{{ $message }}</p>
                                                            @enderror
                                                        </div>
                                                        <div class="mb-3">
                                                            <label
                                                                class="block mb-2 text-md font-medium text-black">Nama
                                                                Produk</label>
                                                            <select name="produk"
                                                                class="bg-white border border-black text-black text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                                                                placeholder="Masukan Produk" autocomplete="off" required>
                                                                <option selected>Pilih Produk</option>
                                                                @foreach ($p as $sil)
                                                                    <option
                                                                        value="{{ $sil->id }}"{{ $sil->id == $isi->id_produk ? 'selected' : '' }}>
                                                                        {{ $sil->nama_p }}
                                                                    </option>
                                                                @endforeach
                                                            </select>
                                                            @error('produk')
                                                                <p class="text-red-600 font-medium text-sm ml-2">
                                                                    *{{ $message }}</p>
                                                            @enderror
                                                        </div>
                                                        <div class="mb-3">
                                                            <label
                                                                class="block mb-2 text-md font-medium text-black">Laporan</label>
                                                            <textarea type="text" name="laporan"
                                                                class="bg-white border border-black text-black text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                                                                placeholder="Masukan Laporan" autocomplete="off" required>{{ $isi->laporan }}</textarea>
                                                            @error('laporan')
                                                                <p class="text-red-600 font-medium text-sm ml-2">
                                                                    *{{ $message }}</p>
                                                            @enderror
                                                        </div>
                                                        <div class="mb-3">
                                                            <button type="submit" name="simpan"
                                                                class="text-white bg-blue-800 hover:bg-blue-900 font-medium rounded-lg text-sm w-full px-5 py-2.5">Simpan</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <form action="{{ route('laporan.destroy', $isi->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-600 text-sm font-medium" onclick="return confirm('Apakah kamu yakin untuk menghapusnya?')">Hapus</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>

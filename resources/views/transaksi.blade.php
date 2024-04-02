<x-app-layout>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
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
                Tambah transaksi
            </button>

            <div id="defaultModal" tabindex="-1" aria-hidden="true"
                class="fixed top-0 left-0 right-0 z-50 hidden w-full p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] max-h-full">
                <div class="relative w-full max-w-2xl max-h-full">
                    <div class="relative bg-white rounded-xl shadow">
                        <div class="flex bg-blue-800 items-start justify-between p-4 border-b rounded-lg">
                            <h3 class="text-xl font-semibold text-white">
                                Tambah transaksi
                            </h3>
                        </div>
                        <div class="p-6 space-y-6">
                            <form action="{{ route('transaksi.store') }}" method="post" enctype="multipart/form-data">
                                @csrf
                                <div class="mb-3">
                                    <label class="block mb-2 text-md font-medium text-black">Tanggal Transaksi</label>
                                    <input type="date" name="tanggal"
                                        class="bg-white border border-black text-black text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                                        placeholder="Masukkan Nama" autocomplete="off" required
                                        value="{{ old('tanggal') }}">
                                    @error('tanggal')
                                        <p class="text-red-600 font-medium text-sm ml-2">*{{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label class="block mb-2 text-md font-medium text-black">Nama Pengurus</label>
                                    <select name="pengurus"
                                        class="bg-white border border-black text-black text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                                        required>
                                        <option disabled selected>Pilih Pengurus</option>
                                        @foreach ($ps as $sel)
                                            <option value="{{ $sel->id }}"
                                                {{ old('pengurus') == $sel->id ? 'selected' : '' }}>
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
                                        required>
                                        <option disabled selected>Pilih Supplier</option>
                                        @foreach ($sup as $sil)
                                            <option value="{{ $sil->id }}"
                                                {{ old('supplier') == $sil->id ? 'selected' : '' }}>
                                                {{ $sil->nama_s }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('supplier')
                                        <p class="text-red-600 font-medium text-sm ml-2">*{{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label class="block mb-2 text-md font-medium text-black">Produk Transaksi</label>
                                    <select name="produk"
                                        class="bg-white border border-black text-black text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                                        required>
                                        <option disabled selected>Pilih Produk</option>
                                        @foreach ($pro as $sul)
                                            <option value="{{ $sul->id }}"
                                                {{ old('produk') == $sul->id ? 'selected' : '' }}>
                                                {{ $sul->nama_p }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('produk')
                                        <p class="text-red-600 font-medium text-sm ml-2">*{{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label class="block mb-2 text-md font-medium text-black">Jumlah</label>
                                    <input type="number" name="stok"
                                        class="bg-white border border-black text-black text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                                        placeholder="Masukkan Jumlah" autocomplete="off" required
                                        value="{{ old('stok') }}">
                                    @error('stok')
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
                                Tanggal
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Nama Pengurus
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Nama Supplier
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Produk yang dibeli
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Jumlah
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
                                    {{ $isi->tanggal }}
                                </td>
                                <td class="px-6 py-4">
                                    {{ $isi->pengurus->nama_ps }}
                                </td>
                                <td class="px-6 py-4">
                                    {{ $isi->supplier->nama_s }}
                                </td>
                                <td class="px-6 py-4">
                                    {{ $isi->produk->nama_p }}
                                </td>
                                <td class="px-6 py-4">
                                    {{ $isi->stok }}
                                </td>
                                <td class="px-6 py-4 flex">
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
                                                    <form action="{{ route('transaksi.update', ['id' => $isi->id]) }}"
                                                        method="post">
                                                        @method('PUT')
                                                        @csrf
                                                        <div class="mb-3">
                                                            <label
                                                                class="block mb-2 text-md font-medium text-black">Tanggal
                                                                Transaksi</label>
                                                            <input type="date" name="tanggal"
                                                                value="{{ $isi->tanggal }}"
                                                                class="bg-white border border-black text-black text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                                                                placeholder="Tanggal Transaksi" autocomplete="off"
                                                                required>
                                                        </div>
                                                        <div class="mb-3">
                                                            <label
                                                                class="block mb-2 text-md font-medium text-black">Nama
                                                                Pengurus</label>
                                                            <select name="pengurus"
                                                                class="bg-white border border-black text-black text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                                                                placeholder="Pilih Pengurus" autocomplete="off"
                                                                required>
                                                                <option disabled selected>Pilih Pengurus</option>
                                                                @foreach ($ps as $sel)
                                                                    <option
                                                                        value="{{ $sel->id }}"{{ $sel->id == $isi->id_pengurus ? 'selected' : '' }}>
                                                                        {{ $sel->nama_ps }}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                        <div class="mb-3">
                                                            <label
                                                                class="block mb-2 text-md font-medium text-black">Nama
                                                                Supplier</label>
                                                            <select name="supplier"
                                                                class="bg-white border border-black text-black text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                                                                placeholder="Pilih Supplier" autocomplete="off"
                                                                required>
                                                                <option disabled selected>Pilih Supplier</option>
                                                                @foreach ($sup as $sil)
                                                                    <option
                                                                        value="{{ $sil->id }}"{{ $sil->id == $isi->id_supplier ? 'selected' : '' }}>
                                                                        {{ $sil->nama_s }}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                        <div class="mb-3">
                                                            <label
                                                                class="block mb-2 text-md font-medium text-black">Produk
                                                                Transaksi</label>
                                                            <select name="produk"
                                                                class="bg-white border border-black text-black text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                                                                placeholder="Pilih Produk" autocomplete="off"
                                                                required>
                                                                <option disabled selected>Pilih Produk</option>
                                                                @foreach ($pro as $sul)
                                                                    <option
                                                                        value="{{ $sul->id }}"{{ $sul->id == $isi->id_produk ? 'selected' : '' }}>
                                                                        {{ $sul->nama_p }}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                        <div class="mb-3">
                                                            <label
                                                                class="block mb-2 text-md font-medium text-black">Jumlah
                                                                Stok</label>
                                                            <input type="number" name="stok"
                                                                value="{{ $isi->stok }}"
                                                                class="bg-white border border-black text-black text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                                                                placeholder="Masukkan Jumlah Stok" autocomplete="off"
                                                                required>
                                                        </div>
                                                        @if ($errors->has('stok'))
                                                            <span
                                                                class="text-red-500">{{ $errors->first('stok') }}</span>
                                                        @endif56
                                                        
                                                        <div class="mb-3">
                                                            <button type="submit" name="simpan"
                                                                class="text-white bg-blue-800 hover:bg-blue-900 font-medium rounded-lg text-sm w-full px-5 py-2.5">Simpan</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <form action="{{ route('transaksi.destroy', $isi->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-600 text-sm font-medium"
                                            onclick="return confirm('Apakah kamu yakin untuk menghapusnya?')">Hapus</button>
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

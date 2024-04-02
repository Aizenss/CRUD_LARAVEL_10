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
                Tambah Produk
            </button>

            <div id="defaultModal" tabindex="-1" aria-hidden="true"
                class="fixed top-0 left-0 right-0 z-50 hidden w-full p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] max-h-full">
                <div class="relative w-full max-w-2xl max-h-full">
                    <div class="relative bg-white rounded-xl shadow">
                        <div class="flex bg-blue-800 items-start justify-between p-4 border-b rounded-lg">
                            <h3 class="text-xl font-semibold text-white">
                                Tambah Produk
                            </h3>
                        </div>
                        <div class="p-6 space-y-6">
                            <form action="{{ route('produk.store') }}" method="post" enctype="multipart/form-data">
                                @csrf
                                <div class="mb-3">
                                    <label class="block mb-2 text-md font-medium text-black">Nama Produk</label>
                                    <input type="text" name="nama" value="{{ old('nama') }}"
                                        class="bg-white border border-black text-black text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                                        placeholder="Masukkan Nama" autocomplete="off">
                                    @error('nama')
                                        <p class="text-red-500 text-sm mt-1">*{{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label class="block mb-2 text-md font-medium text-black" for="file_input">Unggah foto</label>
                                    <input class="block w-full text-sm text-black border border-black rounded-lg cursor-pointer bg-gray-50"
                                        id="file_input" name="foto" type="file" accept="image/*">
                                    @error('foto')
                                        <p class="text-red-500 text-sm mt-1">*{{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label class="block mb-2 text-md font-medium text-black">Harga</label>
                                    <input type="number" name="harga" value="{{ old('harga') }}"
                                        class="bg-white border border-black text-black text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                                        placeholder="Masukkan Harga" autocomplete="off">
                                    @error('harga')
                                        <p class="text-red-500 text-sm mt-1">*{{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label class="block mb-2 text-md font-medium text-black">Kategori</label>
                                    <select type="kategori" name="kategori"
                                        class="bg-white border border-black text-black text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                                        placeholder="Masukkan kategori" autocomplete="off">
                                        <option disabled selected>Pilih Kategori</option>
                                        @foreach ($s as $sel)
                                            <option value="{{ $sel->id }}" {{ old('kategori') == $sel->id ? 'selected' : '' }}>
                                                {{ $sel->nama_k }}</option>
                                        @endforeach
                                    </select>
                                    @error('kategori')
                                        <p class="text-red-500 text-sm mt-1">*{{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label class="block mb-2 text-md font-medium text-black">Stok</label>
                                    <input type="number" name="stok" value="{{ old('stok') }}"
                                        class="bg-white border border-black text-black text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                                        placeholder="Masukkan Stok" autocomplete="off">
                                    @error('stok')
                                        <p class="text-red-500 text-sm mt-1">*{{ $message }}</p>
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

            <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
                <table class="w-full text-sm text-left text-gray-500">
                    <thead class="text-xs text-white uppercase bg-blue-800">
                        <tr>
                            <th scope="col" class="px-6 py-3">
                                #
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Foto
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Nama Produk
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Harga
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Kategori
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Stok
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
                                    <img src="{{ asset('images/' . $isi->foto) }}" alt="{{ $isi->nama_p }}"
                                        width="150" class="rounded rounded-xl">
                                </td>
                                <td class="px-6 py-4">
                                    {{ $isi->nama_p }}
                                </td>
                                <td class="px-6 py-4">
                                    {{ 'Rp ' . number_format($isi->harga, 0, ',', '.') }}
                                </td>
                                <td class="px-6 py-4">
                                    {{ $isi->kategori->nama_k }}
                                </td>
                                <td class="px-6 py-4">
                                    {{ $isi->stok }}
                                </td>
                                <td class="px-6 py-4">
                                    <button data-modal-target="modal{{ $isi->id }}"
                                        data-modal-toggle="modal{{ $isi->id }}"
                                        class="text-blue-600 text-sm font-medium mr-3" type="button">Edit
                                    </button>
                                    <div id="modal{{ $isi->id }}" tabindex="-1" aria-hidden="true"
                                        class="fixed top-0 left-0 right-0 z-50 hidden w-full p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] max-h-full">
                                        <div class="relative w-full max-w-2xl max-h-full">
                                            <div class="relative bg-white rounded-xl shadow">
                                                <div
                                                    class="flex bg-blue-800 items-start justify-between p-4 border-b rounded-lg">
                                                    <h3 class="text-xl font-semibold text-white">
                                                        Edit Kategori
                                                    </h3>
                                                </div>
                                                <div class="p-6 space-y-6">
                                                    <form action="{{ route('produk.update', ['id' => $isi->id]) }}"
                                                        method="post" enctype="multipart/form-data">
                                                        @method('PUT')
                                                        @csrf
                                                        <div class="mb-3">
                                                            <label
                                                                class="block mb-2 text-md font-medium text-black">Nama
                                                                Produk</label>
                                                            <input type="text" name="nama"
                                                                value="{{ $isi->nama_p }}"
                                                                class="bg-white border border-black text-black text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                                                                placeholder="Masukan Nama" autocomplete="off">
                                                            @error('nama')
                                                                <p class="text-red-500 text-sm mt-1">*{{ $message }}
                                                                </p>
                                                            @enderror
                                                        </div>
                                                        <div class="mb-3 flex">
                                                            <p class="block mb-2 text-md font-medium text-black mr-4">
                                                                Foto saat ini : </p>
                                                            <img src="{{ asset('images/' . $isi->foto) }}"
                                                                alt="{{ $isi->nama_p }}" width="150"
                                                                class="rounded-xl">
                                                        </div>
                                                        <div class="mb-3">
                                                            <label class="block mb-2 text-md font-medium text-black"
                                                                for="file_input">Unggah foto</label>
                                                            <input
                                                                class="block w-full text-sm text-black border border-black rounded-lg cursor-pointer bg-gray-50"
                                                                id="file_input" name="foto" type="file"
                                                                accept="image/*">
                                                                @error('foto')
                                                                <p class="text-red-500 text-sm mt-1">*{{ $message }}
                                                                </p>
                                                            @enderror
                                                        </div>
                                                        <div class="mb-3">
                                                            <label
                                                                class="block mb-2 text-md font-medium text-black">Harga</label>
                                                            <input type="number" name="harga"
                                                                value="{{ $isi->harga }}"
                                                                class="bg-white border border-black text-black text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                                                                placeholder="Masukan Harga" autocomplete="off">
                                                                @error('harga')
                                                                <p class="text-red-500 text-sm mt-1">*{{ $message }}
                                                                </p>
                                                            @enderror
                                                        </div>
                                                        <div class="mb-3">
                                                            <label
                                                                class="block mb-2 text-md font-medium text-black">kategori</label>
                                                            <select type="kategori" name="kategori"
                                                                class="bg-white border border-black text-black text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                                                                placeholder="Masukan kategori" autocomplete="off">
                                                                <option disabled selected>Pilih Kategori</option>
                                                                @foreach ($s as $sel)
                                                                    <option
                                                                        value="{{ $sel->id }}"{{ $sel->id == $isi->id_kategori ? 'selected' : '' }}>
                                                                        {{ $sel->nama_k }}
                                                                    </option>
                                                                @endforeach
                                                            </select>
                                                            @error('kategori')
                                                                <p class="text-red-500 text-sm mt-1">*{{ $message }}
                                                                </p>
                                                            @enderror
                                                        </div>
                                                        <div class="mb-3">
                                                            <label
                                                                class="block mb-2 text-md font-medium text-black">Stok</label>
                                                            <input type="number" name="stok"
                                                                value="{{ $isi->stok }}"
                                                                class="bg-white border border-black text-black text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                                                                placeholder="Masukan Stok" autocomplete="off">
                                                                @error('stok')
                                                                <p class="text-red-500 text-sm mt-1">*{{ $message }}
                                                                </p>
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
                                    <form action="{{ route('produk.destroy', $isi->id) }}" method="POST">
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
<script>
    document.addEventListener("DOMContentLoaded", function() {
        const form = document.querySelector("form");

        form.addEventListener("submit", function(event) {
            if (!form.checkValidity()) {
                event.preventDefault();
            }
        });
    });
</script>

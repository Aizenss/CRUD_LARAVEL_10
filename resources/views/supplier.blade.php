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
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <button data-modal-target="defaultModal" data-modal-toggle="defaultModal"
                    class="block text-white bg-blue-800 hover:bg-blue-900 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center mb-3 ms-2"
                    type="button">
                    Tambah Supplier
                </button>

                <div id="defaultModal" tabindex="-1" aria-hidden="true"
                    class="fixed top-0 left-0 right-0 z-50 hidden w-full p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] max-h-full">
                    <div class="relative w-full max-w-2xl max-h-full">
                        <div class="relative bg-white rounded-xl shadow">
                            <div class="flex bg-blue-800 items-start justify-between p-4 border-b rounded-lg">
                                <h3 class="text-xl font-semibold text-white">
                                    Tambah Supplier
                                </h3>
                            </div>
                            <div class="p-6 space-y-6">
                                <form action="{{ route('supplier.store') }}" method="post">
                                    @csrf
                                    <div class="mb-3">
                                        <label class="block mb-2 text-md font-medium text-black">Nama Supplier</label>
                                        <input type="text" name="nama" value="{{ old('nama') }}"
                                            class="bg-white border border-black text-black text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                                            placeholder="Masukan Nama" autocomplete="off" required>
                                        @error('nama')
                                            <p class="text-red-600 font-medium text-sm ml-2">*{{ $message }}</p>
                                        @enderror
                                    </div>
                                    <div class="mb-3">
                                        <label class="block mb-2 text-md font-medium text-black">Alamat</label>
                                        <textarea type="text" name="alamat"
                                            class="bg-white border border-black text-black text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                                            placeholder="Masukan Alamat" autocomplete="off" required>{{ old('alamat') }}</textarea>
                                        @error('alamat')
                                            <p class="text-red-600 font-medium text-sm ml-2">*{{ $message }}</p>
                                        @enderror
                                    </div>
                                    <div class="mb-3">
                                        <label class="block mb-2 text-md font-medium text-black">No Hp</label>
                                        <input type="number" name="no_hp" value="{{ old('no_hp') }}" min="0"
                                            class="bg-white border border-black text-black text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                                            placeholder="08xxxxxxxxxx" autocomplete="off" required>
                                        @error('no_hp')
                                            <p class="text-red-600 font-medium text-sm ml-2">*{{ $message }}</p>
                                        @enderror
                                    </div>
                                    <div class="mb-3">
                                        <label class="block mb-2 text-md font-medium text-black">Email</label>
                                        <input type="email" name="email" value="{{ old('email') }}"
                                            class="bg-white border border-black text-black text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                                            placeholder="Masukan Email" autocomplete="off" required>
                                        @error('email')
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
                                    Nama Supplier
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Alamat
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    No Hp
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Email
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
                                        {{ $isi->nama_s }}
                                    </td>
                                    <td class="px-6 py-4">
                                        {{ $isi->alamat_s }}
                                    </td>
                                    <td class="px-6 py-4">
                                        {{ $isi->no_hp_sup }}
                                    </td>
                                    <td class="px-6 py-4">
                                        {{ $isi->email_s }}
                                    </td>
                                    <td class="px-6 py-4 flex">
                                        <button data-modal-target="modal{{ $isi->id }}"
                                            data-modal-toggle="modal{{ $isi->id }}"
                                            class="text-blue-600 text-sm font-medium mr-3" type="button">Edit</button>
                                        <div id="modal{{ $isi->id }}" tabindex="-1" aria-hidden="true"
                                            class="fixed top-0 left-0 right-0 z-50 hidden w-full p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] max-h-full">
                                            <div class="relative w-full max-w-2xl max-h-full">
                                                <div class="relative bg-white rounded-xl shadow">
                                                    <div
                                                        class="flex bg-blue-800 items-start justify-between p-4 border-b rounded-lg">
                                                        <h3 class="text-xl font-semibold text-white">
                                                            Edit Supplier
                                                        </h3>
                                                    </div>
                                                    <div class="p-6 space-y-6">
                                                        <form action="{{ route('supplier.update', ['id' => $isi->id]) }}" method="post">
                                                            @method('PUT')
                                                            @csrf
                                                            <div class="mb-3">
                                                                <label class="block mb-2 text-md font-medium text-black">Nama Supplier</label>
                                                                <input type="text" name="nama" value="{{ $isi->nama_s }}"
                                                                    class="bg-white border border-black text-black text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                                                                    placeholder="Masukan Nama" autocomplete="off" required>
                                                                @error('nama')
                                                                    <p class="text-red-600 font-medium text-sm ml-2">*{{ $message }}</p>
                                                                @enderror
                                                            </div>
                                                            <div class="mb-3">
                                                                <label class="block mb-2 text-md font-medium text-black">Alamat</label>
                                                                <textarea type="text" name="alamat"
                                                                    class="bg-white border border-black text-black text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                                                                    placeholder="Masukan Alamat" autocomplete="off" required>{{ $isi->alamat }}</textarea>
                                                                @error('alamat')
                                                                    <p class="text-red-600 font-medium text-sm ml-2">*{{ $message }}</p>
                                                                @enderror
                                                            </div>
                                                            <div class="mb-3">
                                                                <label class="block mb-2 text-md font-medium text-black">No Hp</label>
                                                                <input type="number" name="no_hp" value="{{ $isi->no_hp_sup }}" min="0"
                                                                    class="bg-white border border-black text-black text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                                                                    placeholder="08xxxxxxxxxx" autocomplete="off" required>
                                                                @error('no_hp')
                                                                    <p class="text-red-600 font-medium text-sm ml-2">*{{ $message }}</p>
                                                                @enderror
                                                            </div>
                                                            <div class="mb-3">
                                                                <label class="block mb-2 text-md font-medium text-black">Email</label>
                                                                <input type="email" name="email" value="{{ $isi->email }}"
                                                                    class="bg-white border border-black text-black text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                                                                    placeholder="Masukan Email" autocomplete="off" required>
                                                                @error('email')
                                                                    <p class="text-red-600 font-medium text-sm ml-2">*{{ $message }}</p>
                                                                @enderror
                                                            </div>
                                                            <div class="mb-3">
                                                                <button type="submit" name="simpan_kategori"
                                                                    class="text-white bg-blue-800 hover:bg-blue-900 font-medium rounded-lg text-sm w-full px-5 py-2.5">Simpan</button>
                                                            </div>
                                                        </form>                                                        
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div>
                                            <form action="{{ route('supplier.destroy', $isi->id) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="text-red-600 text-sm font-medium" onclick="return confirm('Apakah kamu yakin untuk menghapusnya?')">Hapus</button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
</x-app-layout>
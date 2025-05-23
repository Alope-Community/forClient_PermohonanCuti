@extends('layouts.main')

@section('content')
<div class="container mx-auto mt-4">
    <h2 class="text-2xl font-bold mb-4">Verifikasi Cuti</h2>

    <div class="overflow-x-auto">
        <table class="table-auto w-full border">
            <thead class="bg-gray-100">
                <tr>
                    <th class="px-4 py-2 border">Nama</th>
                    <th class="px-4 py-2 border">Tanggal Mulai</th>
                    <th class="px-4 py-2 border">Tanggal Selesai</th>
                    <th class="px-4 py-2 border">Alasan</th>
                    <th class="px-4 py-2 border">Aksi</th>
                </tr>
            </thead>
            <tbody>
                <!-- Data dummy statis -->
                <tr class="border-b">
                    <td class="px-4 py-2 border">Firdan Fauzan</td>
                    <td class="px-4 py-2 border">2025-06-01</td>
                    <td class="px-4 py-2 border">2025-06-05</td>
                    <td class="px-4 py-2 border">Liburan keluarga</td>
                    <td class="px-4 py-2 border">
                        <div class="flex items-center space-x-2">
                            <select name="status" class="border px-2 py-1 rounded text-sm">
                                <option value="disetujui">Setujui</option>
                                <option value="ditolak">Tolak</option>
                            </select>


                        </div>
                    </td>
                </tr>

            </tbody>
        </table>
    </div>
    <div class="text-end mt-3">
        <button
            onclick="alert('Status cuti dikirim!')"
            type="button"
            class="btn btn-primary btn-sm">
            Kirim
        </button>
    </div>

</div>
@endsection

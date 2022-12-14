@extends('layouts.app')

@section('content')
<div class="container-xl">
    <!-- Page title -->
    <div class="page-header d-print-none">
        <div class="row align-items-center mb-3">
            <div class="col">
                <!-- Page pre-title -->
                <div class="page-pretitle">
                    {{ $pretitle }}
                </div>
                <h2 class="page-title">
                    {{ $title }}
                </h2>
            </div>

            <!-- Page title actions -->
            <div class="col-auto ms-auto d-print-none">
                <div class="btn-list">
                    <a href="{{ route('relations.class-student.create') }}" class="btn btn-primary">
                        <!-- Download SVG icon from http://tabler-icons.io/i/plus -->
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24"
                            stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round"
                            stroke-linejoin="round">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                            <line x1="12" y1="5" x2="12" y2="19" />
                            <line x1="5" y1="12" x2="19" y2="12" />
                        </svg>
                        Tambah Data Kelas Siswa
                    </a>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-header row">
                    <div class="col-md-6 mb-3 mb-md-0">
                        <h3 class="card-title">Daftar Relasi {{ $title }}</h3>
                    </div>
                    <div class="col-md-6 d-flex align-items-center">
                        <x-filters.sort route="relations.class-student.index" :sorts="
                        [
                            [
                                'sort' => 'created_at',
                                'direction' => 'asc',
                                'text' => 'Terbaru'
                            ],
                            [
                                'sort' => 'created_at',
                                'direction' => 'desc',
                                'text' => 'Terlama'
                            ],
                            [
                                'sort' => 'name',
                                'direction' => 'asc',
                                'text' => 'Nama'
                            ]
                        ]" />
                        <x-filters.search route="relations.class-student.index" />
                    </div>
                </div>

                <div class="table-responsive">
                    <table class="table card-table text-wrap datatable">
                        <thead>
                            <tr>
                                <th class="w-1">No.</th>
                                <th>Nama Kelas</th>
                                <th>Siswa-siswa</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @if( $classes->isNotEmpty() )
                            @foreach($classes as $class)
                            <tr>
                                <td><span class="text-muted">{{ ($classes->currentpage()-1) * $classes->perpage() +
                                        $loop->index + 1 }}</span></td>
                                <td style="white-space: nowrap;">
                                    {{ $class->name }}
                                </td>
                                <td>
                                    @foreach ($class->students as $student)
                                    <a target="_blank"
                                        href="{{ route('master.students.index', ['search' => $student->nis]) }}"
                                        class="d-inline-block badge bg-success mb-1 text-uppercase">{{ $student->name
                                        }} - (NIS/NISN: {{ $student->nis }})</a>
                                    @endforeach
                                </td>
                                <td class="text-center">
                                    <span class="dropdown">
                                        <button class="btn dropdown-toggle align-text-top" data-bs-boundary="viewport"
                                            data-bs-toggle="dropdown">Aksi</button>
                                        <div class="dropdown-menu dropdown-menu-end">
                                            <form
                                                action="{{ route('relations.class-student.destroy', ['class_student' => $class->id]) }}"
                                                method="post">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit"
                                                    onclick="return confirm('Apakah anda yakin ingin menghapus data ini?')"
                                                    class="dropdown-item btn-danger">
                                                    Hapus
                                                </button>
                                            </form>
                                            <a class="dropdown-item"
                                                href="{{ route('relations.class-student.edit', ['class_student' => $class->id]) }}">
                                                Edit
                                            </a>
                                        </div>
                                    </span>
                                </td>
                            </tr>
                            @endforeach
                            @else
                            <tr>
                                <td colspan="8">
                                    <p class="text-danger py-3 m-0 text-center">Data relasi kelas siswa tidak ditemukan.
                                    </p>
                                </td>
                            </tr>
                            @endif
                        </tbody>
                    </table>
                </div>

                <div class="card-footer d-flex align-items-center justify-content-between">
                    {{ $classes->onEachSide(5)->links() }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
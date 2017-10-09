@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                @component('components.panel')
                    @slot('title')
                        Scrapers
                    @endslot
                    <ul>
                        @foreach($publications as $publication)
                            <li>
                                @if (!$publication->last_run_result)
                                    <span class="label label-default">Never run</span>
                                @elseif ($publication->last_run_result == \App\Services\ScrapingService::RUN_RESULT_OK)
                                    <span class="label label-success">ok</span>
                                @else
                                    <span class="label label-danger">error</span>
                                @endif
                                {{$publication->name}}
                                @if ($publication->last_run_at)
                                    {{ $publication->last_run_at->diffForHumans() }}
                                @endif
                            </li>
                        @endforeach
                    </ul>
                @endcomponent

                @component('components.panel')
                    @slot('title')
                        Runs
                    @endslot
                    <table class="table table-bordered table-condensed">
                        @foreach($runs as $run)
                            <tr>
                                <td>
                                @if (!$run->result)
                                    <span class="label label-default">Never run</span>
                                @elseif ($run->result == \App\Services\ScrapingService::RUN_RESULT_OK)
                                    <span class="label label-success">ok</span>
                                @else
                                    <span class="label label-danger">error</span>
                                @endif
                                </td>
                                <td>{{ $run->publication->name }}</td>
                                <td>{{ ceil($run->duration) }}s</td>
                                <td>{{ $run->new_files }}</td>
                                <td>{{ $run->created_at->diffForHumans() }}</td>
                            </tr>
                        @endforeach
                    </table>
                @endcomponent
            </div>
        </div>
    </div>
@endsection

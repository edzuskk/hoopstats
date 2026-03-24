<x-layout>
    {{-- Šeit tiek izmantots if un elseif cikls, kas iekrāso zaļā krāsā to statistiku, kura ir lielāka, sarkanā — kura ir mazāka, un dzeltenā — ja tā ir vienāda.--}}
    @if(isset($team1) && isset($team2) && $team1->pts > $team2->pts)
        <style>
            .Apts {
                color: #4CAF50;
            }
            .Bpts {
                color: #f44336;
            }
        </style>
    @elseif(isset($team1) && isset($team2) && $team2->pts > $team1->pts)
        <style>
            .Bpts {
                color: #4CAF50;
            }
            .Apts {
                color: #f44336;
            }
        </style>
    @elseif(isset($team1) && isset($team2) && $team1->pts === $team2->pts)
        <style>
            .Apts, .Bpts {
                color: #cf9f01;
            }
        </style>
    @endif

    @if(isset($team1) && isset($team2) && $team1->reb > $team2->reb)
        <style>
            .Areb {
                color: #4CAF50;
            }
            .Breb {
                color: #f44336;
                }
        </style>
    @elseif(isset($team1) && isset($team2) && $team2->reb > $team1->reb)
        <style>
            .Areb {
                color: #f44336;
            }
            .Breb {
                color: #4CAF50;
            }
        </style>
    @elseif(isset($team1) && isset($team2) && $team1->reb === $team2->reb)
        <style>
            .Areb, .Breb {
                color: #cf9f01;
            }
           </style>
    @endif

    @if(isset($team1) && isset($team2) && $team1->ast > $team2->ast)
        <style>
            .Aast {
                color: #4CAF50;
            }
            .Bast {
                color: #f44336;
                }
        </style>
    @elseif(isset($team1) && isset($team2) && $team2->ast > $team1->ast)
        <style>
            .Aast {
                color: #f44336;
            }
            .Bast {
                color: #4CAF50;
            }
        </style>
    @elseif(isset($team1) && isset($team2) && $team1->ast === $team2->ast)
        <style>
            .Aast, .Bast {
                color: #cf9f01;
            }
           </style>
    @endif

    @if(isset($team1) && isset($team2) && $team1->blk > $team2->blk)
        <style>
            .Ablk {
                color: #4CAF50;
            }
            .Bblk {
                color: #f44336;
                }
        </style>
    @elseif(isset($team1) && isset($team2) && $team2->blk > $team1->blk)
        <style>
            .Ablk {
                color: #f44336;
            }
            .Bblk {
                color: #4CAF50;
            }
        </style>
    @elseif(isset($team1) && isset($team2) && $team1->blk === $team2->blk)
        <style>
            .Ablk, .Bblk {
                color: #cf9f01;
            }
           </style>
    @endif

    @if(isset($team1) && isset($team2) && $team1->stl > $team2->stl)
        <style>
            .Astl {
                color: #4CAF50;
            }
            .Bstl {
                color: #f44336;
                }
        </style>
    @elseif(isset($team1) && isset($team2) && $team2->stl > $team1->stl)
        <style>
            .Astl {
                color: #f44336;
            }
            .Bstl {
                color: #4CAF50;
            }
        </style>
    @elseif(isset($team1) && isset($team2) && $team1->stl === $team2->stl)
        <style>
            .Astl, .Bstl {
                color: #cf9f01;
            }
           </style>
    @endif

    <div class="compare-page">
        <section class="compare-hero">
            <h1>Komandu salīdzināšana</h1>
            <p class="compare-subtitle">Izvēlieties divas komandas un salīdziniet to sniegumu galvenajās statistikas kategorijās.</p>
        </section>

        <section class="compare-panel">
            <form action="{{ route('teams.compare') }}" method="POST" class="compare-form">
                @csrf
                <label class="compare-field" for="team1">
                    <span>Komanda A</span>
                    <select id="team1" name="team1" class="compare-select">
                        <option value="">Izvēlieties komandu</option>
                        {{-- -Dod iespēju izvēlēties komandu A, lai salīdzinātu to ar komandu B --}}
                        @foreach($teams as $team)
                            <option value="{{ $team->id }}" @selected((string) ($team1->id ?? '') === (string) $team->id)>
                                {{ $team->name }}
                            </option>
                        @endforeach
                    </select>
                </label>

                <span class="compare-divider">VS</span>

                <label class="compare-field" for="team2">
                    <span>Komanda B</span>
                    <select id="team2" name="team2" class="compare-select">
                        <option value="">Izvēlieties komandu</option>
                        {{-- -Dod iespēju izvēlēties komandu B, lai salīdzinātu to ar komandu A --}}
                        @foreach($teams as $team)
                            <option value="{{ $team->id }}" @selected((string) ($team2->id ?? '') === (string) $team->id)>
                                {{ $team->name }}
                            </option>
                        @endforeach
                    </select>
                </label>

                <button type="submit" class="compare-btn">Salīdzināt</button>
            </form>
        </section>

        <section>
            <h2 class="compare-result-text">Salīdzinājuma rezultāti</h2>

            <div class="compare-results">
                <article class="compare-card">
                    <header class="compare-card-header">
                        <p class="compare-card-label">Komanda A</p>
                        {{-- Šis teksts rādas, ja komanda nav izvēlēta --}}
                        <h3>{{ $team1->name ?? 'Nav izvēlēta' }}</h3>
                    </header>

                    <div class="compare-table-wrap">
                        <table class="compare-table">
                            <thead>
                                <tr>
                                    <th>Punkti</th>
                                    <th>Atl. bumbas</th>
                                    <th>Rezult. Piesp.</th>
                                    <th>Bloķ. metieni</th>
                                    <th>Nozagt. Bumb.</th>
                                </tr>
                            </thead>
                            <tbody>
                                {{-- Šeit tiek parādīta komandas A statistika, ja komanda ir izvēlēta, pretējā gadījumā tiek parādīts teksts, aicinot izvēlēties komandu --}}
                                @if(isset($team1))
                                    <tr>
                                        <td class="Apts">{{ $team1->pts ?? '-' }}</td>
                                        <td class="Areb">{{ $team1->reb ?? '-' }}</td>
                                        <td class="Aast">{{ $team1->ast ?? '-' }}</td>
                                        <td class="Ablk">{{ $team1->blk ?? '-' }}</td>
                                        <td class="Astl">{{ $team1->stl ?? '-' }}</td>
                                    </tr>
                                    {{-- Šis teksts rādas, ja komanda A nav izvēlēta --}}
                                @else
                                    <tr>
                                        <td class="compare-empty" colspan="6">Izvēlies komandu A, lai redzētu statistiku.</td>
                                    </tr>
                                @endif
                            </tbody>
                        </table>
                    </div>
                </article>

                <article class="compare-card">
                    <header class="compare-card-header">
                        <p class="compare-card-label">Komanda B</p>
                        {{-- Šis teksts rādas, ja komanda nav izvēlēta --}}
                        <h3>{{ $team2->name ?? 'Nav izvēlēta' }}</h3>
                    </header>

                    <div class="compare-table-wrap">
                        <table class="compare-table">
                            <thead>
                                <tr>
                                    <th>Punkti</th>
                                    <th>Atl. bumbas</th>
                                    <th>Rezult. Piesp.</th>
                                    <th>Bloķ. metieni</th>
                                    <th>Nozagt. Bumb.</th>
                                </tr>
                            </thead>
                            <tbody>
                                {{-- Šeit tiek parādīta komandas B statistika, ja komanda ir izvēlēta, pretējā gadījumā tiek parādīts teksts, aicinot izvēlēties komandu /// --}}
                                @if(isset($team2))
                                    <tr>
                                        <td class="Bpts">{{ $team2->pts ?? '-' }}</td>
                                        <td class="Breb">{{ $team2->reb ?? '-' }}</td>
                                        <td class="Bast">{{ $team2->ast ?? '-' }}</td>
                                        <td class="Bblk">{{ $team2->blk ?? '-' }}</td>
                                        <td class="Bstl">{{ $team2->stl ?? '-' }}</td>
                                    </tr>
                                {{-- Šis teksts rādas, ja komanda B nav izvēlēta --}}
                                @else
                                    <tr>
                                        <td class="compare-empty" colspan="6">Izvēlies komandu B, lai redzētu statistiku.</td>
                                    </tr>
                                @endif
                            </tbody>
                        </table>
                    </div>
                </article>
            </div>
        </section>
    </div>
</x-layout>
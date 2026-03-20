<x-layout>
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
                                @if(isset($team1))
                                    <tr>
                                        <td>{{ $team1->pts ?? '-' }}</td>
                                        <td>{{ $team1->reb ?? '-' }}</td>
                                        <td>{{ $team1->ast ?? '-' }}</td>
                                        <td>{{ $team1->blk ?? '-' }}</td>
                                        <td>{{ $team1->stl ?? '-' }}</td>
                                    </tr>
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
                                @if(isset($team2))
                                    <tr>
                                        <td>{{ $team2->pts ?? '-' }}</td>
                                        <td>{{ $team2->reb ?? '-' }}</td>
                                        <td>{{ $team2->ast ?? '-' }}</td>
                                        <td>{{ $team2->blk ?? '-' }}</td>
                                        <td>{{ $team2->stl ?? '-' }}</td>
                                    </tr>
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
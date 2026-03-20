<x-layout>
    <div class="compare-page">
        <section class="compare-hero">
            <h1>Spēlētāju salīdzinātājs</h1>
            <p class="compare-subtitle">Izvēlies divus spēlētājus un salīdzini viņu šo sezonas statisiku.</p>
        </section>

        <section class="compare-panel">
            <form action="{{ route('players.compare') }}" method="POST" class="compare-form">
                @csrf
                <label class="compare-field" for="player1">
                    <span>Spēlētājs A</span>
                    <select id="player1" name="player1" class="compare-select">
                        <option value="">Izvēlieties spēlētāju</option>
                        @foreach($players as $player)
                            <option value="{{ $player->id }}" @selected((string) ($player1->id ?? '') === (string) $player->id)>
                                {{ $player->full_name }}
                            </option>
                        @endforeach
                    </select>
                </label>

                <span class="compare-divider">VS</span>

                <label class="compare-field" for="player2">
                    <span>Spēlētājs B</span>
                    <select id="player2" name="player2" class="compare-select">
                        <option value="">Izvēlieties spēlētāju</option>
                        @foreach($players as $player)
                            <option value="{{ $player->id }}" @selected((string) ($player2->id ?? '') === (string) $player->id)>
                                {{ $player->full_name }}
                            </option>
                        @endforeach
                    </select>
                </label>

                <button type="submit" class="compare-btn">Salīdzināt</button>
            </form>
        </section>

        <section>
            <h2 class="compare-result-text" >Salīdzinājuma rezultāti</h2>

            <div class="compare-results">
                <article class="compare-card">
                    <header class="compare-card-header">
                        <p class="compare-card-label">Spēlētājs A</p>
                        <h3>{{ $player1->full_name ?? 'Nav izvēlēts' }}</h3>
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
                                @if(isset($player1))
                                    <tr>
                                        <td>{{ $player1->ppg ?? '-' }}</td>
                                        <td>{{ $player1->rpg ?? '-' }}</td>
                                        <td>{{ $player1->apg ?? '-' }}</td>
                                        <td>{{ $player1->bpg ?? '-' }}</td>
                                        <td>{{ $player1->spg ?? '-' }}</td>
                                    </tr>
                                @else
                                    <tr>
                                        <td class="compare-empty" colspan="6">Izvēlies spēlētāju A, lai redzētu statistiku.</td>
                                    </tr>
                                @endif
                            </tbody>
                        </table>
                    </div>
                </article>

                <article class="compare-card">
                    <header class="compare-card-header">
                        <p class="compare-card-label">Spēlētājs B</p>
                        <h3>{{ $player2->full_name ?? 'Nav izvēlēts' }}</h3>
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
                                @if(isset($player2))
                                    <tr>
                                        <td>{{ $player2->ppg ?? '-' }}</td>
                                        <td>{{ $player2->rpg ?? '-' }}</td>
                                        <td>{{ $player2->apg ?? '-' }}</td>
                                        <td>{{ $player2->bpg ?? '-' }}</td>
                                        <td>{{ $player2->spg ?? '-' }}</td>
                                    </tr>
                                @else
                                    <tr>
                                        <td class="compare-empty" colspan="6">Izvēlies spēlētāju B, lai redzētu statistiku.</td>
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
<x-layout>
    {{-- Šeit tiek izmantots if un elseif cikls, kas iekrāso zaļā krāsā to statistiku, kura ir lielāka, sarkanā — kura ir mazāka, un dzeltenā — ja tā ir vienāda.--}}
    @if(isset($player1) && isset($player2) && $player1->ppg > $player2->ppg)
        <style>
            .Appg {
                color: #4CAF50;
            }
            .Bppg {
                color: #f44336;
            }
        </style>
    @elseif(isset($player1) && isset($player2) && $player2->ppg > $player1->ppg)
        <style>
            .Bppg {
                color: #4CAF50;
            }
            .Appg {
                color: #f44336;
            }
        </style>
    @elseif(isset($player1) && isset($player2) && $player1->ppg === $player2->ppg)
        <style>
            .Appg, .Bppg {
                color: #cf9f01;
            }
        </style>
    @endif

    @if(isset($player1) && isset($player2) && $player1->rpg > $player2->rpg)
        <style>
            .Arpg {
                color: #4CAF50;
            }
            .Brpg {
                color: #f44336;
            }
        </style>
    @elseif(isset($player1) && isset($player2) && $player2->rpg > $player1->rpg)
        <style>
            .Arpg {
                color: #f44336;
            }
            .Brpg {
                color: #4CAF50;
            }
        </style>
    @elseif(isset($player1) && isset($player2) && $player1->rpg === $player2->rpg)
        <style>
            .Arpg, .Brpg {
                color: #cf9f01;
            }
        </style>
    @endif

    @if(isset($player1) && isset($player2) && $player1->apg > $player2->apg)
        <style>
            .Aapg {
                color: #4CAF50;
            }
            .Bapg {
                color: #f44336;
            }
        </style>
    @elseif(isset($player1) && isset($player2) && $player2->apg > $player1->apg)
        <style>
            .Aapg {
                color: #f44336;
            }
            .Bapg {
                color: #4CAF50;
            }
        </style>
    @elseif(isset($player1) && isset($player2) && $player1->apg === $player2->apg)
        <style>
            .Aapg, .Bapg {
                color: #cf9f01;
            }
        </style>
    @endif

    @if(isset($player1) && isset($player2) && $player1->bpg > $player2->bpg)
        <style>
            .Abpg {
                color: #4CAF50;
            }
            .Bbpg {
                color: #f44336;
            }
        </style>
    @elseif(isset($player1) && isset($player2) && $player2->bpg > $player1->bpg)
        <style>
            .Abpg {
                color: #f44336;
            }
            .Bbpg {
                color: #4CAF50;
            }
        </style>
    @elseif(isset($player1) && isset($player2) && $player1->bpg === $player2->bpg)
        <style>
            .Abpg, .Bbpg {
                color: #cf9f01;
            }
        </style>
    @endif

    @if(isset($player1) && isset($player2) && $player1->spg > $player2->spg)
        <style>
            .Aspg {
                color: #4CAF50;
            }
            .Bspg {
                color: #f44336;
            }
        </style>
    @elseif(isset($player1) && isset($player2) && $player2->spg > $player1->spg)
        <style>
            .Aspg {
                color: #f44336;
            }
            .Bspg {
                color: #4CAF50;
            }
        </style>
    @elseif(isset($player1) && isset($player2) && $player1->spg === $player2->spg)
        <style>
            .Aspg, .Bspg {
                color: #cf9f01;
            }
        </style>
    @endif

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
                        {{-- Šis cikls dod iespēju izvēlēties spēlētāju A --}}
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
                        {{-- Šis cikls dod iespēju izvēlēties spēlētāju B --}}
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
                        {{-- Šis teksts parādas ja spēlētājs B nav izvēlēts --}}
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
                                {{-- Šis cikls parāda spēlētāja A statistiku --}}
                                @if(isset($player1))
                                    <tr>
                                        <td class="Appg">{{ $player1->ppg ?? '-' }}</td>
                                        <td class="Arpg">{{ $player1->rpg ?? '-' }}</td>
                                        <td class="Aapg">{{ $player1->apg ?? '-' }}</td>
                                        <td class="Abpg">{{ $player1->bpg ?? '-' }}</td>
                                        <td class="Aspg">{{ $player1->spg ?? '-' }}</td>
                                    </tr>
                                @else
                                {{-- Šis teksts parādas ja spēlētājs nav izvēlēts --}}
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
                        {{-- Šis teksts parādas ja spēlētājs B nav izvēlēts --}}
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
                                {{-- Šis cikls parāda spēlētāja A statistiku --}}
                                @if(isset($player2))
                                    <tr>
                                        <td class="Bppg">{{ $player2->ppg ?? '-' }}</td>
                                        <td class="Brpg">{{ $player2->rpg ?? '-' }}</td>
                                        <td class="Bapg">{{ $player2->apg ?? '-' }}</td>
                                        <td class="Bbpg">{{ $player2->bpg ?? '-' }}</td>
                                        <td class="Bspg">{{ $player2->spg ?? '-' }}</td>
                                    </tr>
                                @else
                                {{-- Šis teksts parādas ja spēlētājs nav izvēlēts --}}
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
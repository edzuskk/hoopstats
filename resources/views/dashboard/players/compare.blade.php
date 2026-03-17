<x-layout>
    <h1>Spēlētāju salīdzinātājs</h1>
    <p style="color: black; font-size: 24px;">Izvēlaties spēlētājus, lai salīdzināt viņus</p>

    <div style="display: flex; gap: 10px; align-items: center;">
        <form action="{{ route('players.compare') }}" method="POST">
            @csrf
            <select name="player1">
                <option value="">Izvēlieties spēlētāju</option>
                @foreach($players as $player)
                    <option value="{{ $player->id }}">{{ $player->full_name }}</option>
                @endforeach
            </select>

            <span>un</span>

            <select name="player2">
                <option value="">Izvēlieties spēlētāju</option>
                @foreach($players as $player)
                    <option value="{{ $player->id }}">{{ $player->full_name }}</option>
                @endforeach
            </select>

            <button type="submit">Salīdzināt</button>
        </form>
    </div><br>

    <h1>Salīdzinājuma rezultāti</h1>

    <div class="conference-tables">
        <div class="conference-table">
            <table>
                <thead>
                    <tr>
                        <th>Spēlētājs</th>
                        <th>Punkti</th>
                        <th>Atlēkušās bumbas</th>
                        <th>Rezultatīvas piespēles</th>
                        <th>Bloķēti metieni</th>
                        <th>Nozagtas bumbas</th>
                    </tr>
                </thead>
                <tbody id="comparison-results">
                    @if(isset($player1))
                    <tr>
                        <td><a href="{{ route('players.show', $player1) }}">{{ $player1->full_name }}</a></td>
                        <td>{{ $player1->ppg ?? '-'  }}</td>
                        <td>{{ $player1->rpg ?? '-'  }}</td>
                        <td>{{ $player1->apg ?? '-'  }}</td>
                        <td>{{ $player1->bpg ?? '-'  }}</td>
                        <td>{{ $player1->spg ?? '-'  }}</td>
                    </tr>
                    @endif
                </tbody>
            </table>
        </div>

        <div>
            <table>
                <thead>
                    <tr>
                        <th>Spēlētājs</th>
                        <th>Punkti</th>
                        <th>Atlēkušās bumbas</th>
                        <th>Rezultatīvas piespēles</th>
                        <th>Bloķēti metieni</th>
                        <th>Nozagtas bumbas</th>
                    </tr>
                </thead>
                <tbody id="comparison-results">
                    @if(isset($player2))
                    <tr>
                        <td><a href="{{ route('players.show', $player2) }}">{{ $player2->full_name }}</a></td>
                        <td>{{ $player2->ppg ?? '-'  }}</td>
                        <td>{{ $player2->rpg ?? '-'  }}</td>
                        <td>{{ $player2->apg ?? '-'  }}</td>
                        <td>{{ $player2->bpg ?? '-'  }}</td>
                        <td>{{ $player2->spg ?? '-'  }}</td>
                    </tr>
                    @endif
                </tbody>
            </table>
        </div>
    </div>


</x-layout>
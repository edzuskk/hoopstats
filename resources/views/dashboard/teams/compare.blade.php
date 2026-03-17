<x-layout>
    <h1>Komandu salīdzināšana</h1>
    <p style="color: black; font-size: 24px;">Izvēlaties komandas, lai salīdzināt tās</p>
    <div style="display: flex; gap: 10px; align-items: center;">
        <form action="{{ route('teams.compare') }}" method="POST">
            @csrf
            <select name="team1">
                <option value="">Izvēlieties komadu</option>
                @foreach($teams as $team)
                    <option value="{{ $team->id }}">{{ $team->name }}</option>
                @endforeach
            </select>

            <span>un</span>

            <select name="team2">
                <option value="">Izvēlieties Komandu</option>
                @foreach($teams as $team)
                    <option value="{{ $team->id }}">{{ $team->name }}</option>
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
                        <th>Komanda</th>
                        <th>Punkti</th>
                        <th>Atlēkušās bumbas</th>
                        <th>Rezultatīvas piespēles</th>
                        <th>Bloķēti metieni</th>
                        <th>Nozagtas bumbas</th>
                    </tr>
                </thead>
                <tbody id="comparison-results">
                    @if(isset($team1))
                    <tr>
                        <td><a href="{{ route('teams.show', $team1) }}">{{ $team1->name }}</a></td>
                        <td>{{ $team1->pts ?? '-'  }}</td>
                        <td>{{ $team1->reb ?? '-'  }}</td>
                        <td>{{ $team1->ast ?? '-'  }}</td>
                        <td>{{ $team1->stl ?? '-'  }}</td>
                        <td>{{ $team1->blk ?? '-'  }}</td>
                    </tr>
                    @endif
                </tbody>
            </table>
        </div>

        <div>
            <table>
                <thead>
                    <tr>
                        <th>Komanda</th>
                        <th>Punkti</th>
                        <th>Atlēkušās bumbas</th>
                        <th>Rezultatīvas piespēles</th>
                        <th>Bloķēti metieni</th>
                        <th>Nozagtas bumbas</th>
                    </tr>
                </thead>
                <tbody id="comparison-results">
                    @if(isset($team2))
                    <tr>
                        <td><a href="{{ route(name: 'teams.show', parameters: $team2) }}">{{ $team2->name }}</a></td>
                        <td>{{ $team2->pts ?? '-'  }}</td>
                        <td>{{ $team2->reb ?? '-'  }}</td>
                        <td>{{ $team2->ast ?? '-'  }}</td>
                        <td>{{ $team2->stl ?? '-'  }}</td>
                        <td>{{ $team2->blk ?? '-'  }}</td>
                    </tr>
                    @endif
                </tbody>
            </table>
        </div>
    </div>

</x-layout>
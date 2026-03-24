<x-layout>
    <h1>Visas NBA komandas</h1>

    {{-- Šeit tiek izmantots PHP kods, lai sadalītu komandas pēc konferences, un tiek pārbaudīts, vai $teams ir paginators vai kolekcija, lai pareizi apstrādātu datus --}}
    @php
        $teamCollection = $teams instanceof \Illuminate\Pagination\LengthAwarePaginator
            ? $teams->getCollection()
            : collect($teams);

        $easternTeams = $teamCollection->where('conference', 'Eastern');
        $westernTeams = $teamCollection->where('conference', 'Western');
    @endphp

    <div class="conference-tables">
        <div class="conference-table">
            <h2>Austrumu Konference</h2>
            <table>
                <thead>
                    <tr>
                        <th>Komanda</th>
                        <th>Uzvaras</th>
                        <th>Zaudes</th>
                        <th>Vinēšanas %</th>
                    </tr>
                </thead>
                <tbody>
                    {{-- Šeit tiek izmantots forelse cikls, lai parādītu katru austrumu komandu un to statistiku, kā arī saiti uz tām --}}
                    @forelse ($easternTeams as $team)
                        <tr>
                            <td><a href="{{ route('teams.show', $team) }}">{{ $team->name }}</a></td>
                            <td>{{ is_null($team->w) ? '-' : number_format($team->w) }}</td>
                            <td>{{ is_null($team->l) ? '-' : number_format($team->l) }}</td>
                            <td>{{ is_null($team->w_pct) ? '-' : number_format($team->w_pct * 100, 1) . '%' }}</td>
                        </tr>
                    {{-- Ja komandas nav tad rādas šis teksts --}}
                    @empty
                        <tr>
                            <td colspan="4">Nav komandu šajā konferencē.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="conference-table">
            <h2>Rietumu Konference</h2>
            <table>
                <thead>
                    <tr>
                        <th>Komanda</th>
                        <th>Uzvaras</th>
                        <th>Zaudes</th>
                        <th>Vinēšanas %</th>
                    </tr>
                </thead>
                <tbody>
                    {{-- Šeit tiek izmantots forelse cikls, lai parādītu katru rietumu komandu un to statistiku, kā arī saiti uz tām --}}
                    @forelse ($westernTeams as $team)
                        <tr>
                            <td><a href="{{ route('teams.show', $team) }}">{{ $team->name }}</a></td>
                            <td>{{ is_null($team->w) ? '-' : number_format($team->w) }}</td>
                            <td>{{ is_null($team->l) ? '-' : number_format($team->l) }}</td>
                            <td>{{ is_null($team->w_pct) ? '-' : number_format($team->w_pct * 100, 1) . '%' }}</td>
                        </tr>
                    {{-- Ja komandas nav tad rādas šis teksts --}}
                    @empty
                        <tr>
                            <td colspan="4">Nav komandu šajā konferencē.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</x-layout>
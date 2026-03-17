<x-layout>
  <h1>Visu NBA spēlētāju statistika</h1>
    <div>
    <div class="pagination-simple">
      @if ($players->onFirstPage())
        <span class="disabled">Iepriekšējā</span>
      @else
        <a href="{{ $players->previousPageUrl() }}">Iepriekšējā</a>
      @endif

      <span class="page-info">{{ $players->currentPage() }} / {{ $players->lastPage() }}</span>

      @if ($players->hasMorePages())
        <a href="{{ $players->nextPageUrl() }}">Nākamā</a>
      @else
        <span class="disabled">Nākamā</span>
      @endif
      
        <div class="search-row">
          <form method="GET" action="{{ url('/players') }}" class="search-form">
            <input type="text" name="search" placeholder="Meklēt spēlētāju pēc vārda..." value="{{ request('search') }}" class="search-input">
            <button type="submit" class="search-button">Meklēt</button>
          </form>
        </div>

    </div>
      <table>
        <thead>
          <tr>
            <th>Spēlētājs</th>
            <th>Minūtes</th>
            <th>Punkti</th>
            <th>Atl. bumb.</th>
            <th>Rezult. piesp.</th>
            <th>Bloķ. metieni</th>
            <th>Nozagtas bumb.</th>
            <th>Komanda</th>
          </tr>
        </thead>
        <tbody>
          @foreach ($players as $player)
            <tr>
              <td><a href="{{ route('players.show', $player) }}">{{ $player->full_name }}</a></td>
              <td>{{ is_null($player->min) ? '-' : number_format($player->min, 1) }}</td>
              <td>{{ is_null($player->ppg) ? '-' : number_format($player->ppg, 1) }}</td>
              <td>{{ is_null($player->rpg) ? '-' : number_format($player->rpg, 1) }}</td>
              <td>{{ is_null($player->apg) ? '-' : number_format($player->apg, 1) }}</td>
              <td>{{ is_null($player->bpg) ? '-' : number_format($player->bpg, 1) }}</td>
              <td>{{ is_null($player->spg) ? '-' : number_format($player->spg, 1) }}</td>
              <td>
                @if($player->teamModel)
                  <a href="{{ route('teams.show', $player->teamModel) }}">{{ $player->teamModel->name }}</a>
                @else
                  -
                @endif
              </td>
            </tr>
          @endforeach
        </tbody>
      </table>
    </div>

</x-layout>
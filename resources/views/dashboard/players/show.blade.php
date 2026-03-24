<x-layout>
    <div>
        <section class="detail-card">
            <a class="back-link" href="/players">← Atpakaļ uz spēlētājiem</a>
            <br><br>
            <h1>{{ $players->full_name }}</h1>

            <p>
                @if(!empty($players->photo_url))
                    <div class="player-photo-wrap">
                        <img class="player-photo" src="{{ $players->photo_url }}" alt="{{ $players->full_name }} photo">
                    </div>
                @endif
            </p>

            <div class="detail-grid">
                <p><span>Komanda:</span>
                    @if($players->teamModel)
                        <a href="{{ route('teams.show', $players->teamModel) }}">{{ $players->teamModel->name }}</a>
                    @else
                        -
                    @endif
                </p>
                <p><span>No:</span> {{ $players->country }}</p>
                <p><span>Garums:</span> {{ $players->height }}m</p>
                <p><span>Svars:</span> {{ $players->weight }}kg</p>
                <p><span>Pozīcija:</span> {{ $players->position }}</p>
                <p><span>Koledža:</span> {{ $players->college }}</p>
            </div>

            @if(!empty($players->draft_year) && !empty($players->draft_round) && !empty($players->draft_number))
                <p class="detail-note"><span>Iesaukšana (Draft):</span> 
                    {{ $players->draft_year }}. gads, 
                    {{ $players->draft_round }}. raunds,
                    {{ $players->draft_number }}. pēc skaita.
                </p>
            @else
                <p class="detail-note">Spēlētājs netika iesaukts, bet pievienojās komandai no "Free Agency".</p>
            @endif
        </section>

        <div>
            <section class="detail-card">
            <p>Statistika</p>
            <div class="detail-grid">
                <p><span>Minūtes:</span> {{ is_null($players->min) ? '-' : number_format($players->min, 1) }}</p>
                <p><span>Spēles spēlētas</span> {{ is_null($players->gp) ? '-' : number_format($players->gp ) }}</p>
                <p><span>Punkt. par spēli:</span> {{ is_null($players->ppg) ? '-' : number_format($players->ppg, 1) }}</p>
                <p><span>Atlēk. bumbas:</span> {{ is_null($players->rpg) ? '-' : number_format($players->rpg, 1) }}</p>
                <p><span>Rezult. piespēles:</span> {{ is_null($players->apg) ? '-' : number_format($players->apg, 1) }}</p>
                <p><span>Bloķ. metieni:</span> {{ is_null($players->bpg) ? '-' : number_format($players->bpg, 1) }}</p>
                <p><span>Nozagt. bumbas:</span> {{ is_null($players->spg) ? '-' : number_format($players->spg, 1) }}</p>
                <p><span>Zaudēta bumba:</span> {{ is_null($players->tpg) ? '-' : number_format( $players->tpg, 1) }}</p>
                <p><span>Lauk. gūtie grozi:</span> {{ is_null($players->fgm) ? '-' : number_format($players->fgm, 1) }}</p>
                <p><span>Lauk. grozu mēģ.:</span> {{ is_null($players->fga) ? '-' : number_format($players->fga, 1) }}</p>
                <p><span>Gūto grozu %:</span> {{ is_null($players->fg_prc) ? '-' : number_format($players->fg_prc, 1) }}</p>
                <p><span>3pt trāp.:</span> {{ is_null($players->three_pm) ? '-' : number_format($players->three_pm, 1) }}</p>
                <p><span>3pt meģ.:</span> {{ is_null($players->three_pa) ? '-' : number_format($players->three_pa, 1) }}</p>
                <p><span>3pt %:</span> {{ is_null($players->three_prc) ? '-' : number_format($players->three_prc, 1) }}</p>
                <p><span>Soda met. trāp.:</span> {{ is_null($players->ftm) ? '-' : number_format($players->ftm, 1) }}</p>
                <p><span>Soda met. meiģ.:</span> {{ is_null($players->fta) ? '-' : number_format($players->fta, 1) }}</p>
                <p><span>Soda met. %: </span> {{ is_null($players->ft_prc) ? '-' : number_format($players->ft_prc, 1) }}</p>
                <p><span>Uzbr. atlēk. bumbas:</span> {{ is_null($players->oreb) ? '-' : number_format($players->oreb, 1) }}</p>
                <p><span>Aizsar. atlēk. bumbas:</span> {{ is_null($players->dreb) ? '-' : number_format($players->dreb, 1) }}</p>
                <p><span>Pers. sodi:</span> {{ is_null($players->pf) ? '-' : number_format($players->pf, 1) }}</p>
                <p><span>Double-Double:</span> {{ is_null($players->dd2) ? '-' : number_format($players->dd2) }}</p>
                <p><span>Triple-Double:</span> {{ is_null($players->td3) ? '-' : number_format($players->td3) }}</p>
                <p><span>+/-</span> {{ is_null($players->plus_minus) ? '-' : number_format($players->plus_minus) }}</p>


            </div>
        </div>
        </section>
    </div>
</x-layout>
<x-layout>
    <section class="detail-card">
        <h1>{{ $teams->name }}</h1>
        <p>Rekords: Uzvaras {{ $teams->w }} / Zaudes: {{ $teams->l }}</p>

        <p>Logotips:
            @if(!empty($teams->logo_url))
                <div class="team-logo-wrap">
                    <img class="team-logo" src="{{ $teams->logo_url }}" alt="{{ $teams->name }} logo">
                </div>
            @endif
        </p>

        <div class="detail-grid">
            <p><span>Konference:</span> {{ $teams->conference }}</p>
            <p><span>Divīzija:</span> {{ $teams->division }}</p>
            <p><span>Pilsēta:</span> {{ $teams->city }}</p>
            <p><span>Arena:</span> {{ $teams->arena }}</p>
            <p><span>Galvenais treneris:</span> {{ $teams->head_coach }}</p>
            <p><span>Lead assistant coach:</span> {{ $teams->lead_assistant_coach ?? 'Šai komandai tāda trenera nav'}}</p>
            <p><span>Assistant coach:</span> {{ $teams->assistant_coach ?? 'Šai komandai tāda trenera nav'}}</p>
            <p><span>Treneris:</span> {{ $teams->trainer }}</p>
            <p><span>Attīstības treneris:</span> {{ $teams->coach_development ?? 'Šai komandai tāda trenera nav'}}</p>
            <p><span>Lead Assistant Coach:</span> {{ $teams->lead_assistant_coach ?? 'Šai komandai nav tāda trenera'}}</p>
            <p><span>Izveidota:</span> {{ $teams->founded }} gadā</p>
            <p><span>Uzvarēti NBA čempionāti:</span> {{ $teams->championships }}</p>
        </div>
    </section>
    
    <section class="detail-card">
        <h2>Spēlētāji šajā komandā:</h2>
        @if($teams->players->isEmpty())
            <p class="detail-note">Šajā komandā nav spēlētāju.</p>
        @else
            <ul class="player-list">
                @foreach($teams->players as $player)
                    <li><a href="{{ route('players.show', $player) }}">{{ $player->full_name }}</a> {{ $player->position }}</li>
                @endforeach
            </ul>
        @endif
    </section>

    <section class="detail-card">
        <h2>Komandas statistika (vidēji)</h2>
        <div class="detail-grid">
            <p><span>Spēles spēlētas:</span> {{ $teams->gp ?? '-' }}</p>
            <p><span>Uzvaras%:</span> {{ is_null($teams->w_pct) ? '-' : number_format($teams->w_pct * 100, 1) . '%' }}</p>
            <p><span>Minūtes:</span> {{ is_null($teams->min) ? '-' : number_format($teams->min, 1) }}</p>
            <p><span>Punkti:</span> {{ is_null($teams->pts) ? '-' : number_format($teams->pts, 1) }}</p>
            <p><span>Laukum. gorz. trāp:</span> {{ is_null($teams->fgm) ? '-' : number_format($teams->fgm, 1) }}</p>
            <p><span>Laukum. groz. mēģ:</span> {{ is_null($teams->fga) ? '-' : number_format($teams->fga, 1) }}</p>
            <p><span>Groz trāp%:</span> {{ is_null($teams->fg_pct) ? '-' : number_format($teams->fg_pct * 100, 1) . '%' }}</p>
            <p><span>3pt trāpīti:</span> {{ is_null($teams->fg3m) ? '-' : number_format($teams->fg3m, 1) }}</p>
            <p><span>3pt mēģ.:</span> {{ is_null($teams->fg3a) ? '-' : number_format($teams->fg3a, 1) }}</p>
            <p><span>3pt%:</span> {{ is_null($teams->fg3_pct) ? '-' : number_format($teams->fg3_pct * 100, 1) . '%' }}</p>
            <p><span>Soda met. trāp.:</span> {{ is_null($teams->ftm) ? '-' : number_format($teams->ftm, 1) }}</p>
            <p><span>Soda. met. mēg'.:</span> {{ is_null($teams->fta) ? '-' : number_format($teams->fta, 1) }}</p>
            <p><span>Soda metienu%:</span> {{ is_null($teams->ft_pct) ? '-' : number_format($teams->ft_pct * 100, 1) . '%' }}</p>
            <p><span>Uzrbuk. atlēk. bumbas:</span> {{ is_null($teams->oreb) ? '-' : number_format($teams->oreb, 1) }}</p>
            <p><span>Aizsardz. atlēk. bumbas:</span> {{ is_null($teams->dreb) ? '-' : number_format($teams->dreb, 1) }}</p>
            <p><span>Atlēk bumbas:</span> {{ is_null($teams->reb) ? '-' : number_format($teams->reb, 1) }}</p>
            <p><span>Rezult. piesp.:</span> {{ is_null($teams->ast) ? '-' : number_format($teams->ast, 1) }}</p>
            <p><span>Bumbas zaudes:</span> {{ is_null($teams->tov) ? '-' : number_format($teams->tov, 1) }}</p>
            <p><span>Nozag. bumbas:</span> {{ is_null($teams->stl) ? '-' : number_format($teams->stl, 1) }}</p>
            <p><span>Bloķ. met.:</span> {{ is_null($teams->blk) ? '-' : number_format($teams->blk, 1) }}</p>
            <p><span>Person. sodi:</span> {{ is_null($teams->pf_team) ? '-' : number_format($teams->pf_team, 1) }}</p>
            <p><span>Gūtie person. sodi:</span> {{ is_null($teams->pfd) ? '-' : number_format($teams->pfd, 1) }}</p>
            <p><span>+/-:</span> {{ is_null($teams->plus_minus) ? '-' : number_format($teams->plus_minus, 1) }}</p>
        </div>
    </section>
    <br>
    <a class="back-link" href="/teams">← Atpakaļ uz komandām</a>
</x-layout>
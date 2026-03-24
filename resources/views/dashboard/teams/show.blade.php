<x-layout>
    {{-- Šis cikls dod katrai komandai savu krāsu, piemēram ja komandas nosaukums ir "Denver Nuggets" tad komandai ar tādu nosaukumu būs sava krāsa --}}
    @if($teams->name === 'Denver Nuggets')
        <style>
            .detail-card{
                background: linear-gradient(67deg, #0d2440, #fec525, #8b2131);
            }

        </style>
    @elseif($teams->name === 'Los Angeles Lakers')
        <style>
            .detail-card{
                background: linear-gradient(67deg, #552583,   #fdb927);
            }

        </style>
    @elseif($teams->name === 'Golden State Warriors')
        <style>
            .detail-card{
                background: linear-gradient(67deg, #1d428a,   #ffc72c);
            }

        </style>
    @elseif($teams->name === 'Boston Celtics')
        <style>
            .detail-card{
                background: linear-gradient(67deg, #007A33,   #ba9653);
            }

        </style>
    @elseif($teams->name === 'Chicago Bulls')
        <style>
            .detail-card{
                background: linear-gradient(67deg, #ce1141, #000000);
            }

        </style>
    @elseif($teams->name === 'Miami Heat')
        <style>
            .detail-card{
                background: linear-gradient(67deg, #98002e,   #f9a01b);
            }

        </style>
    @elseif($teams->name === 'Brooklyn Nets')
        <style>
            .detail-card{
                background: linear-gradient(67deg, #000000, #000000, #ffffff, #000000, #000000);
            }

        </style>
    @elseif($teams->name === 'Philadelphia 76ers')
        <style>
            .detail-card{
                background: linear-gradient(67deg, #006bb6,   #ed174c);
            }

        </style>
    @elseif($teams->name === 'Toronto Raptors')
        <style>
            .detail-card{
                background: linear-gradient(67deg, #720202,   #000000);
            }

        </style>
    @elseif($teams->name === 'Milwaukee Bucks')
        <style>
            .detail-card{
                background: linear-gradient(67deg, #00471b,   #eee1c6);
            }

        </style>
    @elseif($teams->name === 'Phoenix Suns')
        <style>
            .detail-card{
                background: linear-gradient(67deg, #1d1160,   #e56020);
            }

        </style>
    @elseif($teams->name === 'Dallas Mavericks')
        <style>
            .detail-card{
                background: linear-gradient(67deg, #00538c,   #b8c4ca);
            }

        </style>
    @elseif($teams->name === 'Utah Jazz')
        <style>
            .detail-card{
                background: linear-gradient(67deg, #3E2680,   #3E2680);
            }

        </style>
    @elseif($teams->name === 'Atlanta Hawks')
        <style>
            .detail-card{
                background: linear-gradient(67deg, #e03a3e,   #e03a3e);
            }

        </style>
    @elseif($teams->name === 'New York Knicks')
        <style>
            .detail-card{
                background: linear-gradient(67deg, #006BB6, #F58426, #BEC0C2);
            }

        </style>
    @elseif($teams->name === 'Orlando Magic')
        <style>
            .detail-card{
                background: linear-gradient(67deg, #000000, #0077c0, #ffffff);
            }

        </style>
    @elseif($teams->name === 'Cleveland Cavaliers')
        <style>
            .detail-card{
                background: linear-gradient(67deg, #6f263d, #000000, #ffb81c);
            }

        </style>
    @elseif($teams->name === 'Indiana Pacers')
        <style>
            .detail-card{
                background: linear-gradient(67deg, #002d62, #ffc633);
            }

        </style>
    @elseif($teams->name === 'Memphis Grizzlies')
        <style>
            .detail-card{
                background: linear-gradient(67deg, #718abc, #12173F);
            }

        </style>
    @elseif($teams->name === 'Sacramento Kings')
        <style>
            .detail-card{
                background: linear-gradient(67deg, #5a2d81, #63727a);
            }

        </style>
    @elseif($teams->name === 'New Orleans Pelicans')
        <style>
            .detail-card{
                background: linear-gradient(67deg, #0c2340, #85714d);
            }

        </style>
    @elseif($teams->name === 'Minnesota Timberwolves')
        <style>
            .detail-card{
                background: linear-gradient(67deg, #0f2d52, #08182b);
            }

        </style>
    @elseif($teams->name === 'Portland Trail Blazers')
        <style>
            .detail-card{
                background: linear-gradient(67deg, #e03a3e,   #000000);
            }

        </style>
    @elseif($teams->name === 'Detroit Pistons')
        <style>
            .detail-card{
                background: linear-gradient(67deg, #c8102e,   #1d42ba);
            }

        </style>
    @elseif($teams->name === 'Washington Wizards')
        <style>
            .detail-card{
                background: linear-gradient(67deg, #002B5C,  #e31837, #C4CED4);
            }

        </style>
    @elseif($teams->name === 'Los Angeles Clippers')
        <style>
            .detail-card{
                background: linear-gradient(67deg, #c8102E,#1d428a, #000000);
            }

        </style>
    @elseif($teams->name === 'Charlotte Hornets')
        <style>
            .detail-card{
                background: linear-gradient(67deg, #1d1160, #00b2a9);
            }

        </style>
    @elseif($teams->name === 'Houston Rockets')
        <style>
            .detail-card{
                background: linear-gradient(67deg, #CE1141, #000000);
            }

        </style>
    @elseif($teams->name === 'San Antonio Spurs')
        <style>
            .detail-card{
                background: linear-gradient(67deg, #000000, #000000, #c4ced4, #000000, #000000);
            }

        </style>
    @elseif($teams->name === 'Oklahoma City Thunder')
        <style>
            .detail-card{
                background: linear-gradient(67deg, #007ac1,   #f05133);
            }
        </style>
    @endif

    <section class="detail-card">
        <a class="back-link" href="/teams" style="color: white">← Atpakaļ uz komandām</a>
        <br><br>
        <h1 style="color: white">{{ $teams->name }}</h1>
        <p style="color: white">Rekords: Uzvaras {{ $teams->w }} / Zaudes: {{ $teams->l }}</p>

        <p style="color: white">Logotips:
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
            <p><span>Vadošais trenera asistents:</span> {{ $teams->lead_assistant_coach ?? 'Šai komandai tāda trenera nav'}}</p>
            <p><span>Treneris:</span> {{ $teams->trainer }}</p>
            <p><span>Trenera asistents:</span> {{ $teams->assistant_coach ?? 'Šai komandai tāda trenera nav'}}</p>
            <p><span>Attīstības treneris:</span> {{ $teams->coach_development ?? 'Šai komandai tāda trenera nav'}}</p>
            <p><span>Izveidota:</span> {{ $teams->founded }} gadā</p>
            <p><span>Uzvarēti NBA čempionāti:</span> {{ $teams->championships }}</p>
        </div>
    </section>
    
    <section class="detail-card">
        <h2 style="color: white">Sastāvs:</h2>
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
        <h2 style="color: white">Komandas statistika (vidēji)</h2>
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
</x-layout>
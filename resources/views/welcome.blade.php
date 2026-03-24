<x-layout>
    <div class="container">
        <div class="compare-hero">
            <h1>Sveicināti HoopStats🏀</h1>
            <p>Vietne, kurā varat redzēt NBA komandas un spēlētaju statistiku.</p>
        </div>
        <br>
        <div class="compare-hero">
            <p> Ātra infromācija: </p>
                <p>NBA Līderi: </p>
                    <dl>
                        {{-- Šeit tiek izmantoti cikli, lai parādītu katru līderi un viņu statistiku, kā arī saiti uz viņu profilu --}}
                        @foreach($topShooter as $player)
                            <dt>Visvairāk punktu sezonā: </dt>
                                <dd><a href="{{ route('players.show', $player) }}"> {{ $player->full_name }}</a> - {{ $player->ppg }} 🎯</dd>
                        @endforeach
                        &nbsp
                        @foreach($topRebounder as $player)
                            <dt>Visvairāk atlēkušās bumbas sezonā: </dt>
                                <dd><a href="{{ route('players.show', $player) }}">{{ $player->full_name }}</a> - {{ $player->rpg }} 🏀 </dd>
                        @endforeach
                        &nbsp
                        @foreach($topAssister as $player)
                            <dt>Visvairāk rezultatīvas piespēles sezonā: </dt>
                                <dd><a href="{{ route('players.show', $player) }}">{{ $player->full_name }}</a> - {{ $player->apg }} 🤝</dd>
                        @endforeach
                        &nbsp
                        @foreach($topBlocker as $player)
                            <dt>Visvairāk bloķēti metieni sezonā: </dt>
                                <dd><a href="{{ route('players.show', $player) }}">{{ $player->full_name }}</a> - {{ $player->bpg }} 🛡️</dd>
                        @endforeach 
                        &nbsp
                        @foreach($topStealer as $player)
                            <dt>Visvairāk nozagtas bumbas sezonā: </dt>
                                <dd><a href="{{ route('players.show', $player) }}">{{ $player->full_name }}</a> - {{ $player->spg }} 🥷</dd>
                        @endforeach

                    </ul>
                </li>
            </div>
        </div>
    </div><br>

</x-layout>
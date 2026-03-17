<x-layout>
    <div class="container">
        <h1>Sveicināti HoopStats🏀</h1>
        <p>Vietne, kurā varat redzēt NBA komandas un spēlētaju statistiku.</p>
        <p> Ātra infromācija: </p>
            <p>NBA Līderi: </p>
                <ul>

                    @foreach($topShooter as $player)
                    <li>Visvairāk punktu sezonā: {{ $player->full_name }} - {{ $player->ppg }} 🎯</li>
                    @endforeach
 
                    @foreach($topRebounder as $player)
                    <li>Visvairāk atlēkušās bumbas sezonā: {{ $player->full_name }} - {{ $player->rpg }} </li>
                    @endforeach

                    @foreach($topAssister as $player)
                    <li>Visvairāk rezultatīvas piespēles sezonā: {{ $player->full_name }} - {{ $player->apg }}</li>
                    @endforeach

                    @foreach($topBlocker as $player)
                    <li>Visvairāk bloķēti metieni sezonā: {{ $player->full_name }} - {{ $player->bpg }}</li>
                    @endforeach

                    @foreach($topStealer as $player)
                    <li>Visvairāk nozagtas bumbas sezonā: {{ $player->full_name }} - {{ $player->spg }}</li>
                    @endforeach

                </ul>
            </li>
    </div>
</x-layout>
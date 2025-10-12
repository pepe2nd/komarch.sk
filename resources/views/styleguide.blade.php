@extends('layouts.app')
@section('title', 'Style Guide')
<meta name="robots" content="noindex, nofollow">

@section('content')

@include('components.header.header')

<main class="container mx-auto">
<div>
<div class="row">
    <section class="title">
        <h1>
            V prípade, ak člen*ka SKA dlhodobo nevykonáva činnosť autorizovaného architekta*tky/ autorizovaného krajinného architekta*tky, zvažuje odchod na materskú/ otcovskú dovolenku alebo do dôchodku, resp. sa nachádza v inej špecifickej situácii, odporúčame zvážiť:
        </h1>
        <p>A. Vyčiarknutie zo zoznamu AA/ KA</p>
        <p>B. Pozastavenie činnosti</p>
    </section>

    <hr>

    <section>
        <h1>A. Vyčiarknutie zo zoznamov AA/ KA</h1>

        <ol>
            <li>
                Doručenie vyplnenej žiadosti<br>
                O vyčiarknutie zo zoznamu autorizovaných architektov/ autorizovaných krajinných architektov je potrebné podľa §17 ods.1 písm. b) zákona o autorizovaných architektoch autorizovaných stavebných inžinieroch písomne požiadať.
                <a href="#" url="#" external="external" class="hover:text-blue">
                    Žiadosť o vyčiarknutie
                    <span class="inline-block transform group-hover:translate-x-2 duration-200 icon-arrow-r"></span>
                </a>
            </li>
            <li>
                Vrátenie dokumentov<br>
                Vyčiarknutím zo zoznamu strácajú platnosť autorizačné osvedčenie a pečiatka, ktoré sú prílohou k žiadosti. Ich neodovzdanie je priestupkom.
            </li>
            <li>
                Dátum ukončenia členstva
                Dátum ukončenia členstva nemôže byť retrospektívny. Najskôr je možné žiadateľa*ľku vyčiarknuť dňom doručenia žiadosti s prílohami.
            </li>
            <li>
                Vyrozumenie
                Architekt*ka obdrží z úradu komory písomné oznámenie o vyčiarknutí zo zoznamu. Dňom vyčiarknutia žiadateľovi*ke zaniká oprávnenie na výkon povolania.
            </li>
        </ol>
    </section>

    <section>
        <ul>
            <li>voliť a odvolávať zástupcov komory a členky a členov disciplinárnej komisie, voliť a odvolávať zástupcov komory a členky a členov disciplinárnej komisie, voliť a odvolávať zástupcov komory a členky a členov disciplinárnej komisie,</li>
            <li>zriaďovať úrad komory a určovať základné pravidlá jeho činnosti,</li>
            <li>schvaľovať predpisy komory, etický, disciplinárny a volebný poriadok,</li>
            <li>schvaľovať výšku príspevkov na činnosť orgánov komory a rozpočet komory,</li>
            <li>určovať základné smery a rámcové pravidlá medzinárodnej spolupráce.</li>
        </ul>
    </section>
    <section class="mono">
      <div>
          <p>Čo to pre mňa znamená?</p>
          <p>Oprávnenie zaniká právnickej osobe, ktorá mala na základe tohto osvedčenia vykonaný zápis v Obchodnom registri.</p>
          <p>Fyzická osoba musí požiadať o zánik činnosti na Štatistickom úrade (zánik formy SZČO - slobodné povolanie podľa zákona č.138/1992 v znení neskorších predpisov o autorizovaných architektoch a autorizovaných stavebných inžinieroch; zánik formy v Generickom registri RPO sprostredkuje úrad komory za manipulačný poplatok 15 Eur).</p>
          <p>Je potrebné upovedomiť poisťovňu, v ktorej má osoba uzavreté profesijné poistenie, o ukončení členstva v komore.</p>
      </div>
    </section>
    <section>
        <p>
            Ectectate ari aliquatur rae eictio delenem quideli quatem quiam amus, omnimos aut quas expero tores eicimus
            accumendebis renihilique min eos ma quas et adis corrum volores re magnam qui de sitatur aut qui re,
            sunt poresed ea posandest, qui de cor rerferibus exerchi libeaquibusa dolento officae andipsamus quaecti
            aeriani omnitiberae nos voloren disqui quatus illanis parciaspic tenisse rchiliquat alit eum quat.
            Atet volut alibero rporro cume pos deliquae sitiae pla cum fugit accaecus ea dipsum enihili quiat.
            Untectur molorro que vernam facil maio. Rem aut ad ut volest imet ipsam expliquis sum fugiatur alit doluptius
            nobis diti cuptaqui sequi omniatem. Berum quia dolectus, ad ullorio. Itatusdae natur autam eum sequos
            aut atem exeribus ame ea id mo voluptatur? Quiam ipiducia nos atem ium isquam, velessinus eum fugiatectur,
            cus dem aut doluptatem hilicaest unti ulpa aut que vit eum que nobis experem quate volumenisti berci
            blandipit rest prest acestem qui debis non nihiliqui dunt.
        </p>
    </section>
    <section>
        <p>
          <a href="#" url="#" external="external" class="hover:text-blue">
              Ročenka SKA / Správa o činnosti 2021 - 2023
              <span class="inline-block transform group-hover:translate-x-2 duration-200 icon-arrow-r"></span>
          </a>
        </p>
        <p>
          <a href="#" url="#" external="external" class="hover:text-blue">
              XXII. ZASADNUTIE VZ SKA (2023) / uznesenie
              <span class="inline-block transform group-hover:translate-x-2 duration-200 icon-arrow-r"></span>
          </a>
        </p>
        <p>
          <a href="#" url="#" external="external" class="hover:text-blue">
              Štatút Slovenskej komory architektov
              <span class="inline-block transform group-hover:translate-x-2 duration-200 icon-arrow-r"></span>
          </a>
        </p>
    </section>
</div>
</div>
</main>

@endsection

@push('styles')
    <link rel="stylesheet" href="{{ asset('/css/ska.css') }}">
  <!--link rel="stylesheet"
      href="//cdnjs.cloudflare.com/ajax/libs/highlight.js/10.0.3/styles/default.min.css"-->
@endpush

@push('scripts')
  <!--script type="text/javascript" src="/js/styleguide.js"></script>
  <script src="//cdnjs.cloudflare.com/ajax/libs/highlight.js/10.0.3/highlight.min.js"></script-->
@endpush

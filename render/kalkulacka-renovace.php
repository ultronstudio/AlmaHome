<style>
    .row {
        display: flex;
    }

    .col {
        float: left;
        padding: 10px;
    }
</style>
<h2 class="elementor-heading-title elementor-size-default" style="color: var(--e-global-color-secondary);"><?= $titulek ?></h2>
<form class="elementor-form" method="post" name="New Form">
    <div class="elementor-form-fields-wrapper elementor-labels-above">
        <table style="width: 100%" class="kalkulacka">
            <tr class="elementor-field-type-text elementor-field-group elementor-field-group-name" style="margin-bottom: 10px; width: 100%">
                <td style="width: fit-content;"><label for="spakas_okenni_kridlo_pocet" class="elementor-field-label">Špaletové/kastlové okenní křídlo (<b><?= empty($okenni_kridlo_od) && empty($okenni_kridlo_do) ? 0 : number_format($okenni_kridlo_od, 0, ',', ' ') . " - " . number_format($okenni_kridlo_do, 0, ',', ' ') ?> Kč/ks</b>)</label></td>
                <td><input type="number" name="spakas_okenni_kridlo_pocet" id="spakas_okenni_kridlo_pocet" class="elementor-field elementor-size-md elementor-field-textual" placeholder="Počet okenních křídel" style="width: 100%;" min="0"></td>
            </tr>
            <tr class="elementor-field-type-text elementor-field-group elementor-field-group-name" style="margin-bottom: 10px; width: 100%">
                <td style="width: fit-content;"><label for="euro_okno_pocet" class="elementor-field-label">Euro okno (<b><?= empty($euro_okno_od) && empty($euro_okno_do) ? 0 : number_format($euro_okno_od, 0, ',', ' ') . " - " . number_format($euro_okno_do, 0, ',', ' ') ?> Kč/ks</b>)</label></td>
                <td><input type="number" name="euro_okno_pocet" id="euro_okno_pocet" class="elementor-field elementor-size-md elementor-field-textual" placeholder="Počet okenních křídel" style="width: 100%;" min="0"></td>
            </tr>
        </table>
    </div>
</form>
<p>Cena: <b style="color: #000 !important;"><span id="cena-renovace"><?= $cena ?></span> Kč</b> (<?= !empty($ceny_bez_dph) && $ceny_bez_dph == "yes" ? "bez DPH" : "s DPH"; ?>)</p>
<div style="border-top: none; margin-top: 10px; color: var(--e-global-color-primary) !important">
    <?= $popis ?>
</div>
<script>
    document.addEventListener("DOMContentLoaded", function() {
        var okenni_kridlo_od = document.getElementById("spakas_okenni_kridlo_pocet");
        var euro_okno = document.getElementById("euro_okno_pocet");
        var cenaRenovace = document.getElementById("cena-renovace");

        function updateCenaRenovace() {
            alma.Zprava("Aktualizuji celkovou cenu renovace");

            var cena_okenni_kridlo_od = parseFloat(okenni_kridlo_od.value) || 0;
            var cena_euro_okno = parseFloat(euro_okno.value) || 0;

            var novaCena = (cena_okenni_kridlo_od * <?= empty($okenni_kridlo_od) ? 0 : esc_html($okenni_kridlo_od) ?>) +
                (cena_euro_okno * <?= empty($euro_okno_od) ? 0 : esc_html($euro_okno_od) ?>);
            var novaCena2 = (cena_okenni_kridlo_od * <?= empty($okenni_kridlo_do) ? 0 : esc_html($okenni_kridlo_do) ?>) +
                (cena_euro_okno * <?= empty($euro_okno_do) ? 0 : esc_html($euro_okno_do) ?>);

            if(novaCena > 0) {
                cenaRenovace.innerHTML = `od ${alma.CzechPrice(novaCena, 0)} do ${alma.CzechPrice(novaCena2, 0)}`;
            } else {
                cenaRenovace.innerHTML = 0;
            }

            alma.Zprava("Aktualizace celkové ceny renovace dokončena");
        }

        okenni_kridlo_od.addEventListener("input", updateCenaRenovace);
        euro_okno.addEventListener("input", updateCenaRenovace);
    });
</script>
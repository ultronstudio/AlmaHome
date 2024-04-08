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
    <input type="hidden" name="post_id" value="1596">
    <input type="hidden" name="form_id" value="b06549f">
    <input type="hidden" name="referer_title" value="">

    <input type="hidden" name="queried_id" value="1596">

    <div class="elementor-form-fields-wrapper elementor-labels-above">
        <table style="width: 100%" class="kalkulacka">
            <tr class="elementor-field-type-text elementor-field-group elementor-field-group-name" style="margin-bottom: 10px; width: 100%">
                <td style="width: fit-content;"><label for="form-field-name" class="elementor-field-label">Okenní křídlo (<b><?= empty($okenni_kridlo) ? 0 : esc_html($okenni_kridlo) ?> Kč/ks</b>)</label></td>
                <td><input type="number" name="okenni_kridlo" id="okenni_kridlo" class="elementor-field elementor-size-md elementor-field-textual" placeholder="Počet okenních křídel" style="width: 100%;"></td>
            </tr>
            <tr class="elementor-field-type-text elementor-field-group elementor-field-group-name" style="margin-bottom: 10px; width: 100%">
                <td style="width: fit-content;"><label for="form-field-name" class="elementor-field-label">Křídlo balkónových dvěří (<b><?= empty($balkonove_dvere_kridlo) ? 0 : esc_html($balkonove_dvere_kridlo) ?> Kč/ks</b>)</label></td>
                <td><input type="number" name="balkonove_dvere_kridlo" id="balkonove_dvere_kridlo" class="elementor-field elementor-size-md elementor-field-textual" placeholder="Počet křídel balkónových dveří" style="width: 100%;"></td>
            </tr>
            <tr class="elementor-field-type-text elementor-field-group elementor-field-group-name" style="margin-bottom: 10px; width: 100%">
                <td style="width: fit-content;"><label for="form-field-name" class="elementor-field-label">PSK nebo HS portál (<b><?= empty($psk_hs_portal) ? 0 : esc_html($psk_hs_portal) ?> Kč/ks</b>)</label></td>
                <td><input type="number" name="psk_hs_portal" id="psk_hs_portal" class="elementor-field elementor-size-md elementor-field-textual" placeholder="Počet PSK/HS portálů" style="width: 100%;"></td>
            </tr>
            <tr class="elementor-field-type-text elementor-field-group elementor-field-group-name" style="margin-bottom: 10px; width: 100%">
                <td style="width: fit-content;"><label for="form-field-name" class="elementor-field-label">Výměna těsnění (<b><?= empty($tesneni) ? 0 : esc_html($tesneni) ?> Kč/m</b>)<a href="#postup" style="color: red; text-decoration: none;">*</a></label></td>
                <td><input type="number" name="tesneni" id="tesneni" class="elementor-field elementor-size-md elementor-field-textual" placeholder="Počet metrů těsnění k výměně" style="width: 100%;"></td>
            </tr>
        </table>
    </div>
</form>
<p>Cena: <b><span id="cena-servis"><?= $cena ?></span> Kč</b> (<?= !empty($ceny_bez_dph) && $ceny_bez_dph == "yes" ? "bez DPH" : "s DPH"; ?>)</p>
<div style="border-top: 1px solid black; margin-top: 10px; color: var(--e-global-color-primary) !important">
    <?= $popis ?>
</div>
<script>
    document.addEventListener("DOMContentLoaded", function() {
        var okenni_kridlo = document.getElementById("okenni_kridlo");
        var balkonove_dvere_kridlo = document.getElementById("balkonove_dvere_kridlo");
        var psk_hs_portal = document.getElementById("psk_hs_portal");
        var tesneni = document.getElementById("tesneni");
        var cenaServis = document.getElementById("cena-servis");

        function updateCenaServis() {
            alma.Zprava("Aktualizuji celkovou cenu servisu");

            var cena_okenni_kridlo = parseFloat(okenni_kridlo.value) || 0;
            var cena_balkonove_dvere_kridlo = parseFloat(balkonove_dvere_kridlo.value) || 0;
            var cena_psk_hs_portal = parseFloat(psk_hs_portal.value) || 0;
            var cena_tesneni = parseFloat(tesneni.value) || 0;

            var novaCena = (cena_okenni_kridlo * <?= empty($okenni_kridlo) ? 0 : esc_html($okenni_kridlo) ?>) +
                (cena_balkonove_dvere_kridlo * <?= empty($balkonove_dvere_kridlo) ? 0 : esc_html($balkonove_dvere_kridlo) ?>) +
                (cena_psk_hs_portal * <?= empty($psk_hs_portal) ? 0 : esc_html($psk_hs_portal) ?>) +
                (cena_tesneni * <?= empty($tesneni) ? 0 : esc_html($tesneni) ?>);

            cenaServis.innerHTML = alma.CzechPrice(novaCena, 0);

            alma.Zprava("Aktualizace celkové ceny servisu dokončena");
        }

        okenni_kridlo.addEventListener("input", updateCenaServis);
        balkonove_dvere_kridlo.addEventListener("input", updateCenaServis);
        psk_hs_portal.addEventListener("input", updateCenaServis);
        tesneni.addEventListener("input", updateCenaServis);
    });
</script>
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
<p><?= $popis ?></p>
<form class="elementor-form" method="post" name="New Form">
    <input type="hidden" name="post_id" value="1596">
    <input type="hidden" name="form_id" value="b06549f">
    <input type="hidden" name="referer_title" value="">

    <input type="hidden" name="queried_id" value="1596">

    <div class="elementor-form-fields-wrapper elementor-labels-above">
        <table style="width: 100%">
            <tr class="elementor-field-type-text elementor-field-group elementor-field-group-name" style="margin-bottom: 10px; width: 100%">
                <td style="width: fit-content;"><label for="form-field-name" class="elementor-field-label">Okenní křídlo (<b><?= empty($okenni_kridlo) ? 0 : esc_html($okenni_kridlo) ?> Kč/ks</b>)</label></td>
                <td><input type="number" name="okenni_kridlo" id="okenni_kridlo" class="elementor-field elementor-size-md elementor-field-textual" placeholder="Počet okenních křídel" style="width: 100%;"></td>
            </tr>
            <tr class="elementor-field-type-text elementor-field-group elementor-field-group-name" style="margin-bottom: 10px; width: 100%">
                <td style="width: fit-content;"><label for="form-field-name" class="elementor-field-label">Křídlo balkónových dvěří (<b><?= empty($balkonove_dvere_kridlo) ? 0 : esc_html($balkonove_dvere_kridlo) ?> Kč/ks</b>)</label></td>
                <td><input type="number" name="balkonove_dvere_kridlo" id="balkonove_dvere_kridlo" class="elementor-field elementor-size-md elementor-field-textual" placeholder="Počet křídel balkonovách dveří" style="width: 100%;"></td>
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
<p>Cena: <b><span id="cena"><?= $cena ?></span> Kč</b> (bez DPH)</p>
<div style="border-top: 1px solid black; margin-top: 10px; color: var(--e-global-color-primary) !important">
    <?= $popis ?>
</div>
<script>
    jQuery(document).ready(function($) {
        $("#okenni_kridlo, #balkonove_dvere_kridlo, #psk_hs_portal, #tesneni").on("input", function() {
            var okenni_kridlo = parseFloat($("#okenni_kridlo").val()) || 0;
            var balkonove_dvere_kridlo = parseFloat($("#balkonove_dvere_kridlo").val()) || 0;
            var psk_hs_portal = parseFloat($("#psk_hs_portal").val()) || 0;
            var tesneni = parseFloat($("#tesneni").val()) || 0;

            // Zde můžete upravit logiku pro výpočet ceny podle potřeby
            var novaCena = (okenni_kridlo * <?= empty($okenni_kridlo) ? 0 : esc_html($okenni_kridlo) ?>) + (balkonove_dvere_kridlo * <?= empty($balkonove_dvere_kridlo) ? 0 : esc_html($balkonove_dvere_kridlo) ?>) + (psk_hs_portal * <?= empty($psk_hs_portal) ? 0 : esc_html($psk_hs_portal) ?>) + (tesneni * <?= empty($tesneni) ? 0 : esc_html($tesneni) ?>);

            $("#cena").html(novaCena.toFixed(0));
        });
    });
</script>
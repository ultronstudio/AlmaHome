<?php
namespace almahome\widgets;

use Elementor\Widget_Base;

if(!defined('ABSPATH')) {
    exit;
}

/**
 * Kalkulačka servisu pro ALMa Home
 *
 * @since 1.0.0
 */
class KalkulackaServis extends Widget_Base
{

    /**
     * Jméno widgetu
     * @since 1.0.0
     * @access public
     * @return string Jméno widgetu
     */
    public function get_name() : string
    {
        return "kalkulacka-servis";
    }

	/**
	 * Titulek widgetu
	 * @since 1.0.0
	 * @access public
	 * @return string Titulek widgetu
	 */
	public function get_title() : string
	{
		return esc_html__("Kalkulačka servisu", "alma-home");
	}

	/**
	 * Ikona widgetu
	 * @since 1.0.0
	 * @access public
	 * @return string Ikona widgetu
	 */
	public function get_icon() : string
	{
		return "eicon-cart-solid";
	}

	/**
	 * Kategorie widgetu
	 * @since 1.0.0
	 * @access public
	 * @return array Kategorie widgetu
	 */
	public function get_categories() : array
	{
		return ["almahome"];
	}

	/**
	 * Klíčová slova widgetu
	 * @since 1.0.0
	 * @access public
	 * @return array Klíčová slova widgetu
	 */
	public function get_keywords() : array
	{
		return ["kalkulačka", "cena", "alma home", "almahome", "servis"];
	}

	protected function register_controls() : void {
		$this->start_controls_section(
			'zakladni',
			[
				'label' => esc_html__('Základní', 'alma-home'),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT
			]
		);

		$this->add_control(
			'titulek',
			[
				'label' => esc_html__("Titulek", 'alma-home'),
				'type' => \Elementor\Controls_Manager::TEXT,
				'label_block' => true,
				'placeholder' => esc_html__("Zadejte titulek", 'alma-home'),
				'default' => "Kalkulačka servisu"
			]
		);

		$this->add_control(
			'popis',
			[
				'label' => esc_html__("Popis", 'alma-home'),
				'type' => \Elementor\Controls_Manager::TEXTAREA,
				'label_block' => true,
				'placeholder' => esc_html__("Zadejte popis", 'alma-home')
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'ceny',
			[
				'label' => esc_html__('Ceny', 'alma-home'),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT
			]
		);

		// cena za kus pro okenní křídlo
		$this->add_control(
			'okenni_kridlo',
			[
				'label' => esc_html__("Okenní křídlo (cena za kus, v Kč)", 'alma-home'),
				'type' => \Elementor\Controls_Manager::NUMBER,
				'label_block' => true,
				'placeholder' => esc_html__("100", 'alma-home')
			]
		);

		// cena za kus pro křídlo balkónových dveří
		$this->add_control(
			'balkonove_dvere_kridlo',
			[
				'label' => esc_html__("Křídlo balkónových dvěří (cena za kus, v Kč)", 'alma-home'),
				'type' => \Elementor\Controls_Manager::NUMBER,
				'label_block' => true,
				'placeholder' => esc_html__("100", 'alma-home')
			]
		);

		// cena za kus pro psk nebo hs portál
		$this->add_control(
			'psk_hs_portal',
			[
				'label' => esc_html__("PSK nebo HS portál (cena za kus, v Kč)", 'alma-home'),
				'type' => \Elementor\Controls_Manager::NUMBER,
				'label_block' => true,
				'placeholder' => esc_html__("100", 'alma-home')
			]
		);

		// cena za metr pro výměnu těsnění
		$this->add_control(
			'tesneni',
			[
				'label' => esc_html__("Výměna těsnění (cena za metr, v Kč)", 'alma-home'),
				'type' => \Elementor\Controls_Manager::NUMBER,
				'label_block' => true,
				'placeholder' => esc_html__("100", 'alma-home')
			]
		);

		$this->end_controls_section();
	}

	protected function render() {
		$settings = $this->get_settings_for_display();

		$titulek = $settings["titulek"];
		$popis = $settings["popis"];
		$okenni_kridlo = $settings["okenni_kridlo"];
		$balkonove_dvere_kridlo = $settings["balkonove_dvere_kridlo"];
		$psk_hs_portal = $settings["psk_hs_portal"];
		$tesneni = $settings["tesneni"];

		$cena = 0;

		include_once dirname(__FILE__) . '/../render/kalkulacka-servis.php';
	}
}
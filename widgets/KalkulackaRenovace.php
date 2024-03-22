<?php
namespace almahome\widgets;

use Elementor\Widget_Base;

if(!defined('ABSPATH')) {
    exit;
}

/**
 * Kalkulačka renovace pro ALMa Home
 *
 * @since 1.0.0
 */
class KalkulackaRenovace extends Widget_Base
{

    /**
     * Jméno widgetu
     * @since 1.0.0
     * @access public
     * @return string Jméno widgetu
     */
    public function get_name() : string
    {
        return "kalkulacka-renovace";
    }

	/**
	 * Titulek widgetu
	 * @since 1.0.0
	 * @access public
	 * @return string Titulek widgetu
	 */
	public function get_title() : string
	{
		return esc_html__("Kalkulačka renovace", "alma-home");
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
		return ["kalkulačka", "cena", "alma home", "almahome", "renovace"];
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
				'default' => "Kalkulačka renovace"
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

		// ceny jsou zadávány S nebo BEZ daně
		$this->add_control(
			'ceny_bez_dph',
			[
				'label' => esc_html__('Ceny jsou bez DPH', 'alma-home'),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => esc_html__('Ano', 'alma-home'),
				'label_off' => esc_html__('Ne', 'alma-home'),
				'return_value' => 'yes',
				'default' => 'yes',
			]
		);

		// minimální cena za kus špaletových nebo kastlových okenních křídel
		$this->add_control(
			'okenni_kridlo_od',
			[
				'label' => esc_html__("Špaletové/kastlové okenní křídlo (cena OD, v Kč)", 'alma-home'),
				'type' => \Elementor\Controls_Manager::NUMBER,
				'label_block' => true,
				'placeholder' => esc_html__("100", 'alma-home')
			]
		);
		
		// maximální cena za kus špaletových nebo kastlových okenních křídel
		$this->add_control(
			'okenni_kridlo_do',
			[
				'label' => esc_html__("Špaletové/kastlové okenní křídlo (cena DO, v Kč)", 'alma-home'),
				'type' => \Elementor\Controls_Manager::NUMBER,
				'label_block' => true,
				'placeholder' => esc_html__("500", 'alma-home')
			]
		);

		// cena za kus euro okna
		$this->add_control(
			'euro_okno_od',
			[
				'label' => esc_html__("Euro okno (cena OD, v Kč)", 'alma-home'),
				'type' => \Elementor\Controls_Manager::NUMBER,
				'label_block' => true,
				'placeholder' => esc_html__("100", 'alma-home')
			]
		);
		
		$this->add_control(
			'euro_okno_do',
			[
				'label' => esc_html__("Euro okno (cena DO, v Kč)", 'alma-home'),
				'type' => \Elementor\Controls_Manager::NUMBER,
				'label_block' => true,
				'placeholder' => esc_html__("500", 'alma-home')
			]
		);

		$this->end_controls_section();
	}

	protected function render() {
		$settings = $this->get_settings_for_display();

		$titulek = $settings["titulek"];
		$popis = $settings["popis"];
		$okenni_kridlo_od = $settings["okenni_kridlo_od"];
		$okenni_kridlo_do = $settings["okenni_kridlo_do"];
		$euro_okno_od = $settings["euro_okno_od"];
		$euro_okno_do = $settings["euro_okno_do"];
		$ceny_bez_dph = $settings["ceny_bez_dph"];

		$cena = 0; // Výchozí hodnota

		include_once dirname(__FILE__) . '/../render/kalkulacka-renovace.php';
	}
}
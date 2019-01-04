<?php declare( strict_types=1 );

namespace BrightNucleus\Shortcode;

use BrightNucleus\Config\ConfigFactory;
use BrightNucleus\Config\ConfigInterface;
use PHPUnit\Framework\TestCase;

final class ShortcodeTest extends TestCase {

	public function test_it_can_be_instantiated() {
		$config     = $this->createMock( ConfigInterface::class );
		$attsParser = $this->createMock( ShortcodeAttsParserInterface::class );

		$shortcode = new Shortcode( 'some_tag', $config, $attsParser );

		$this->assertInstanceOf( Shortcode::class, $shortcode );
		$this->assertInstanceOf( ShortcodeInterface::class, $shortcode );
	}

	public function test_it_can_render_a_view_with_an_absolute_path() {
		$config     = ConfigFactory::createFromArray(
			[ 'view' => __DIR__ . '/../fixtures/some_dynamic_view.php' ]
		);
		$attsParser = $this->createMock( ShortcodeAttsParser::class );

		$shortcode = new Shortcode( 'some_tag', $config, $attsParser );

		$output = $shortcode->render( [] );

		$this->assertStringStartsWith(
			'<p>This is a dynamic view with <code>PHP code</code></p>',
			$output
		);
	}
}

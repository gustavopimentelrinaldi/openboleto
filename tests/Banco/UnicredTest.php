<?php

namespace Tests\OpenBoleto\Banco;

use OpenBoleto\Banco\Unicred;
use PHPUnit\Framework\TestCase;

class UnicredTest extends TestCase
{
    /**
     * @return void
     */
    public function testInstantiateWithoutArgumentsShouldWork()
    {
        $this->assertInstanceOf(\OpenBoleto\Banco\Unicred::class, new Unicred());
    }

    /**
     * @return void
     */
    public function testInstantiateShouldWork()
    {
        $instance = new Unicred(
            array(
                // Parâmetros obrigatórios
                'dataVencimento' => new \DateTime('2013-01-01'),
                'valor' => 10.50,
                'agencia' => 3302, // Até 4 dígitos
                'carteira' => 51, // 11, 21, 31, 41 ou 51
                'conta' => 2259, // Até 10 dígitos
                'sequencial' => 13951, // Até 10 dígitos
            )
        );

        $this->assertInstanceOf(\OpenBoleto\Banco\Unicred::class, $instance);
        $this->assertEquals('13693.30202 00000.225904 00001.395136 7 55650000001050', $instance->getLinhaDigitavel());
        $this->assertSame('0000013951-3', (string) $instance->getNossoNumero());
    }
}

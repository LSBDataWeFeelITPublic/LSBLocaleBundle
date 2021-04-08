<?php
declare(strict_types=1);

namespace LSB\LocaleBundle\Command;

use LSB\LocaleBundle\Generator\CountryGenerator;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * Class GenerateCountriesCommand
 * @package LSB\LocaleBundle\Command
 */
class GenerateCountriesCommand extends Command
{
    protected static $defaultName = 'lsb:locale:country:generate-all';

    protected CountryGenerator $countryGenerator;

    /**
     *
     */
    protected function configure()
    {
        $this
            ->setName('lsb:locale:country:generate-all')
            ->setDescription('Generates countries')
            ->setHelp('')
        ;
    }

    /**
     * GenerateCountriesCommand constructor.
     * @param CountryGenerator $countryGenerator
     */
    public function __construct(CountryGenerator $countryGenerator)
    {
        parent::__construct();
        $this->countryGenerator = $countryGenerator;
    }

    /**
     * @param InputInterface $input
     * @param OutputInterface $output
     * @return int|void
     * @throws \Exception
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $this->countryGenerator->importCountries($output);
        return Command::SUCCESS;
    }
}

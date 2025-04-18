<?php

return [
    'seeders' => [
        'attribute' => [
            'attribute-families' => 'Default',
            'attribute-groups'   => [
                'description'      => 'Descrizione',
                'general'          => 'Generale',
                'inventories'      => 'Inventari',
                'meta-description' => 'Meta Descrizione',
                'price'            => 'Prezzo',
                'technical'        => 'Tecnico',
                'shipping'         => 'Spedizione',
            ],
            'attributes' => [
                'brand'                => 'Marca',
                'color'                => 'Colore',
                'cost'                 => 'Costo',
                'description'          => 'Descrizione',
                'featured'             => 'In evidenza',
                'guest-checkout'       => 'Check-out ospite',
                'height'               => 'Altezza',
                'length'               => 'Lunghezza',
                'manage-stock'         => 'Gestisci Stock',
                'meta-description'     => 'Meta Descrizione',
                'meta-keywords'        => 'Meta Parole Chiave',
                'meta-title'           => 'Meta Titolo',
                'name'                 => 'Nome',
                'new'                  => 'Nuovo',
                'price'                => 'Prezzo',
                'product-number'       => 'Numero Prodotto',
                'short-description'    => 'Descrizione Breve',
                'size'                 => 'Taglia',
                'sku'                  => 'SKU',
                'special-price-from'   => 'Prezzo Speciale Da',
                'special-price-to'     => 'Prezzo Speciale A',
                'special-price'        => 'Prezzo Speciale',
                'status'               => 'Stato',
                'tax-category'         => 'Categoria Fiscale',
                'url-key'              => 'Chiave URL',
                'visible-individually' => 'Visibile Singolarmente',
                'weight'               => 'Peso',
                'width'                => 'Larghezza',
            ],
            'attribute-options' => [
                'black'  => 'Nero',
                'green'  => 'Verde',
                'l'      => 'L',
                'm'      => 'M',
                'red'    => 'Rosso',
                's'      => 'S',
                'white'  => 'Bianco',
                'xl'     => 'XL',
                'yellow' => 'Giallo',
            ],
        ],
        'category' => [
            'categories' => [
                'description' => 'Descrizione Categoria Radice',
                'name'        => 'Radice',
            ],
            'category_fields' => [
                'name'        => 'Nome',
                'description' => 'Descrizione',
            ],
        ],
        'cms' => [
            'pages' => [
                'about-us' => [
                    'content' => 'Contenuto della pagina Chi Siamo',
                    'title'   => 'Chi Siamo',
                ],
                'contact-us' => [
                    'content' => 'Contenuto della pagina Contattaci',
                    'title'   => 'Contattaci',
                ],
                'customer-service' => [
                    'content' => 'Contenuto della pagina Servizio Clienti',
                    'title'   => 'Servizio Clienti',
                ],
                'payment-policy' => [
                    'content' => 'Contenuto della pagina Politica di Pagamento',
                    'title'   => 'Politica di Pagamento',
                ],
                'privacy-policy' => [
                    'content' => 'Contenuto della pagina Politica sulla Privacy',
                    'title'   => 'Politica sulla Privacy',
                ],
                'refund-policy' => [
                    'content' => 'Contenuto della pagina Politica di Rimborso',
                    'title'   => 'Politica di Rimborso',
                ],
                'return-policy' => [
                    'content' => 'Contenuto della pagina Politica di Reso',
                    'title'   => 'Politica di Reso',
                ],
                'shipping-policy' => [
                    'content' => 'Contenuto della pagina Politica di Spedizione',
                    'title'   => 'Politica di Spedizione',
                ],
                'terms-conditions' => [
                    'content' => 'Contenuto della pagina Termini e Condizioni',
                    'title'   => 'Termini e Condizioni',
                ],
                'terms-of-use' => [
                    'content' => 'Contenuto della pagina Condizioni d\'uso',
                    'title'   => 'Condizioni d\'uso',
                ],
                'whats-new' => [
                    'content' => 'Contenuto della pagina Novità',
                    'title'   => 'Novità',
                ],
            ],
        ],
        'core' => [
            'channels' => [
                'meta-title'       => 'Negozio dimostrativo',
                'meta-keywords'    => 'Meta parole chiave negozio dimostrativo',
                'meta-description' => 'Meta descrizione negozio dimostrativo',
                'name'             => 'Predefinito',
            ],
            'currencies' => [
                'AED' => 'Dirham',
                'AFN' => 'Nuovo Shekel Israeliano',
                'CNY' => 'Yuan Cinese',
                'EUR' => 'Euro',
                'GBP' => 'Sterlina Britannica',
                'INR' => 'Rupia Indiana',
                'IRR' => 'Rial Iraniano',
                'JPY' => 'Yen Giapponese',
                'RUB' => 'Rublo Russo',
                'SAR' => 'Riyal Saudita',
                'TRY' => 'Lira Turca',
                'UAH' => 'Grivna Ucraina',
                'USD' => 'Dollaro USA',
            ],
        ],
        'customer' => [
            'customer-groups' => [
                'general'   => 'Generale',
                'guest'     => 'Ospite',
                'wholesale' => 'All\'ingrosso',
            ],
        ],
        'inventory' => [
            'inventory-sources' => [
                'name' => 'Predefinito',
            ],
        ],
        'shop' => [
            'theme-customizations' => [
                'all-products' => [
                    'name'    => 'Tutti i Prodotti',
                    'options' => [
                        'title' => 'Tutti i Prodotti',
                    ],
                ],
                'bold-collections' => [
                    'content' => [
                        'btn-title'   => 'Vedi Tutti',
                        'description' => 'Scopri le nostre nuove collezioni audaci! Elevate il tuo stile con design audaci e colori vivaci. Esplora motivi accattivanti e colori che definiscono il tuo guardaroba. Preparati a abbracciare l\'extraordinario!',
                        'title'       => 'Preparati per le nostre nuove Collezioni Audaci!',
                    ],
                    'name' => 'Collezioni Audaci',
                ],
                'categories-collections' => [
                    'name' => 'Collezioni per Categoria',
                ],
                'featured-collections' => [
                    'name'    => 'Collezioni In Evidenza',
                    'options' => [
                        'title' => 'Prodotti In Evidenza',
                    ],
                ],
                'footer-links' => [
                    'name'    => 'Link nel Piede di Pagina',
                    'options' => [
                        'about-us'         => 'Chi Siamo',
                        'contact-us'       => 'Contattaci',
                        'customer-service' => 'Servizio Clienti',
                        'payment-policy'   => 'Politica di Pagamento',
                        'privacy-policy'   => 'Politica sulla Privacy',
                        'refund-policy'    => 'Politica di Rimborso',
                        'return-policy'    => 'Politica di Reso',
                        'shipping-policy'  => 'Politica di Spedizione',
                        'terms-conditions' => 'Termini e Condizioni',
                        'terms-of-use'     => 'Condizioni d\'uso',
                        'whats-new'        => 'Novità',
                    ],
                ],
                'game-container' => [
                    'content' => [
                        'sub-title-1' => 'Le nostre Collezioni',
                        'sub-title-2' => 'Le nostre Collezioni',
                        'title'       => 'Il gioco con le nostre nuove aggiunte!',
                    ],
                    'name' => 'Contenitore di Gioco',
                ],
                'image-carousel' => [
                    'name'    => 'Carosello Immagini',
                    'sliders' => [
                        'title' => 'Preparati per la Nuova Collezione',
                    ],
                ],
                'new-products' => [
                    'name'    => 'Nuovi Prodotti',
                    'options' => [
                        'title' => 'Nuovi Prodotti',
                    ],
                ],
                'offer-information' => [
                    'content' => [
                        'title' => 'Fino al 40% di Sconto sul Tuo Primo Ordine ACQUISTA ORA',
                    ],
                    'name' => 'Informazioni sull\'Offerta',
                ],
                'services-content' => [
                    'description' => [
                        'emi-available-info'   => 'Disponibile EMI senza costi aggiuntivi su tutte le principali carte di credito',
                        'free-shipping-info'   => 'Goditi la spedizione gratuita su tutti gli ordini',
                        'product-replace-info' => 'Sostituzione facile dei prodotti disponibile!',
                        'time-support-info'    => 'Supporto dedicato 24/7 via chat ed email',
                    ],
                    'name'  => 'Contenuto dei Servizi',
                    'title' => [
                        'emi-available'   => 'EMI Disponibile',
                        'free-shipping'   => 'Spedizione Gratuita',
                        'product-replace' => 'Sostituzione Prodotto',
                        'time-support'    => 'Supporto 24/7',
                    ],
                ],
                'top-collections' => [
                    'content' => [
                        'sub-title-1' => 'Le nostre Collezioni',
                        'sub-title-2' => 'Le nostre Collezioni',
                        'sub-title-3' => 'Le nostre Collezioni',
                        'sub-title-4' => 'Le nostre Collezioni',
                        'sub-title-5' => 'Le nostre Collezioni',
                        'sub-title-6' => 'Le nostre Collezioni',
                        'title'       => 'Il gioco con le nostre nuove aggiunte!',
                    ],
                    'name' => 'Collezioni di Tendenza',
                ],
            ],
        ],
        'user' => [
            'roles' => [
                'description' => 'Questo ruolo avrà tutto l\'accesso',
                'name'        => 'Amministratore',
            ],
            'users' => [
                'name' => 'Esempio',
            ],
        ],
    ],

    'installer' => [
        'index' => [
            'create-administrator' => [
                'admin'            => 'Amministratore',
                'unopim'           => 'UnoPim',
                'confirm-password' => 'Conferma Password',
                'email-address'    => 'admin@example.com',
                'email'            => 'Email',
                'password'         => 'Password',
                'title'            => 'Crea Amministratore',
            ],

            'environment-configuration' => [
                'allowed-currencies'  => 'Valute Consentite',
                'allowed-locales'     => 'Locali Consentite',
                'application-name'    => 'Nome dell\'Applicazione',
                'unopim'              => 'UnoPim',
                'chinese-yuan'        => 'Yuan Cinese (CNY)',
                'database-connection' => 'Connessione al Database',
                'database-hostname'   => 'Nome Host del Database',
                'database-name'       => 'Nome del Database',
                'database-password'   => 'Password del Database',
                'database-port'       => 'Porta del Database',
                'database-prefix'     => 'Prefisso del Database',
                'database-username'   => 'Nome Utente Database',
                'default-currency'    => 'Valuta Predefinita',
                'default-locale'      => 'Locale Predefinito',
                'default-timezone'    => 'Fuso Orario Predefinito',
                'default-url-link'    => 'https://localhost',
                'default-url'         => 'URL Predefinito',
                'dirham'              => 'Dirham (AED)',
                'euro'                => 'Euro (EUR)',
                'iranian'             => 'Rial Iraniano (IRR)',
                'israeli'             => 'Shekel Israeliano (ILS)',
                'japanese-yen'        => 'Yen Giapponese (JPY)',
                'mysql'               => 'MySQL',
                'pgsql'               => 'pgSQL',
                'pound'               => 'Sterlina Inglese (GBP)',
                'rupee'               => 'Rupia Indiana (INR)',
                'russian-ruble'       => 'Rublo Russo (RUB)',
                'saudi'               => 'Riyal Saudita (SAR)',
                'select-timezone'     => 'Seleziona il Fuso Orario',
                'sqlsrv'              => 'SQLSRV',
                'title'               => 'Configurazione del Database',
                'turkish-lira'        => 'Lira Turca (TRY)',
                'ukrainian-hryvnia'   => 'Grivnia Ucraina (UAH)',
                'usd'                 => 'Dollaro USA (USD)',
                'warning-message'     => 'Attenzione! Le impostazioni della lingua e della valuta predefinite non possono essere modificate in seguito.',
            ],

            'installation-processing' => [
                'unopim'      => 'Installazione UnoPim',
                'unopim-info' => 'Creazione delle tabelle del database, potrebbe richiedere del tempo',
                'title'       => 'Installazione',
            ],

            'installation-completed' => [
                'admin-panel'               => 'Pannello Amministratore',
                'unopim-forums'             => 'Forum UnoPim',
                'explore-unopim-extensions' => 'Esplora le Estensioni UnoPim',
                'title-info'                => 'UnoPim è stato installato con successo.',
                'title'                     => 'Installazione Completata',
            ],

            'ready-for-installation' => [
                'create-databsae-table'   => 'Crea Tabelle Database',
                'install-info-button'     => 'Clicca il pulsante qui sotto per iniziare',
                'install-info'            => 'per installare UnoPim',
                'install'                 => 'Installa',
                'populate-database-table' => 'Popola le Tabelle del Database',
                'start-installation'      => 'Avvia Installazione',
                'title'                   => 'Pronto per l\'Installazione',
            ],

            'start' => [
                'locale'        => 'Locale',
                'main'          => 'Inizio',
                'select-locale' => 'Seleziona Locale',
                'title'         => 'Installazione UnoPim',
                'welcome-title' => 'Benvenuto in UnoPim :version',
            ],

            'server-requirements' => [
                'calendar'    => 'Calendario',
                'ctype'       => 'cType',
                'curl'        => 'cURL',
                'dom'         => 'DOM',
                'fileinfo'    => 'File Info',
                'filter'      => 'Filtro',
                'gd'          => 'GD',
                'hash'        => 'Hash',
                'intl'        => 'Internazionale',
                'json'        => 'JSON',
                'mbstring'    => 'MBString',
                'openssl'     => 'OpenSSL',
                'pcre'        => 'PCRE',
                'pdo'         => 'PDO',
                'php-version' => '8.2 o superiore',
                'php'         => 'PHP',
                'session'     => 'Sessione',
                'title'       => 'Requisiti di Sistema',
                'tokenizer'   => 'Tokenizer',
                'xml'         => 'XML',
            ],

            'back'                     => 'Indietro',
            'unopim-info'              => 'Progetto Comunitario',
            'unopim-logo'              => 'Logo UnoPim',
            'unopim'                   => 'UnoPim',
            'continue'                 => 'Continua',
            'installation-description' => 'L\'installazione di UnoPim comporta diversi passaggi. Qui una panoramica:',
            'wizard-language'          => 'Lingua del Wizard di Installazione',
            'installation-info'        => 'Siamo felici di vederti qui!',
            'installation-title'       => 'Benvenuto nell\'Installazione',
            'save-configuration'       => 'Salva Configurazione',
            'skip'                     => 'Salta',
            'title'                    => 'Wizard di Installazione UnoPim',
            'webkul'                   => 'Webkul',
        ],
    ],
];

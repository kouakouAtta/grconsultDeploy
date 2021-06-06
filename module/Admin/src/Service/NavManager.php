<?php
namespace Admin\Service;

/**
 * This service is responsible for determining which items should be in the main menu.
 * The items may be different depending on whether the user is authenticated or not.
 */
class NavManager
{
    /**
     * Auth service.
     * @var Laminas\Authentication\Authentication
     */
    private $authService;
    
    /**
     * Url view helper.
     * @var Laminas\View\Helper\Url
     */
    private $urlHelper;
    
    /**
     * RBAC manager.
     * @var Laminas\Service\RbacManager
     */
    private $rbacManager;
    
    /**
     * Constructs the service.
     */
    public function __construct($authService, $urlHelper, $rbacManager) 
    {
        $this->authService = $authService;
        $this->urlHelper = $urlHelper;
        $this->rbacManager = $rbacManager;
    }
    
    /**
     * This method returns menu items depending on whether user has logged in or not.
     */
    public function getMenuItems() 
    {
        $url = $this->urlHelper;
        $items = [];
        
        
        
        // Display "Login" menu item for not authorized user only. On the other hand,
        // display "Admin" and "Logout" menu items only for authorized users.
        
            $items[] = [
                'id' => 'dashbord',
                'label' => 'Accueil',
                'icon' => 'feather-home',
                'link'  => $url('admin'),

            ];

            $items[] = [
                'id' => 'slides',
                'label' => 'Slides',
                'icon' => 'dripicons-network-3',
                'link' => $url('slides')
            ];


            $items[] = [
                'id' => 'utilisateurs',
                'label' => 'Utilisateurs',
                'icon' => 'feather-users',
                'link' => $url('users')
            ];

            $items[] = [
                'id' => 'prestations',
                'label' => 'Prestation de service',
                'icon' => 'dripicons-device-tablet',
                'link' => $url('admin', ['action'=>'prestations-service'])
            ];

            $items[] = [
                'id' => 'formations',
                'label' => 'Formations',
                'icon' => 'dripicons-network-3',
                'link' => $url('admin', ['action'=>'liste-formations'])
            ];

            $items[] = [
                'id' => 'apropos',
                'label' => 'A Propos',
                'icon' => 'dripicons-network-3',
                'link' => $url('apropos')
            ];
            $items[] = [
                'id' => 'clients',
                'label' => 'Clients et Prestataires',
                'icon' => 'dripicons-network-3',
                'link' => $url('clients')
            ];
            $items[] = [
                'id' => 'banniere',
                'label' => 'Bannière',
                'icon' => 'dripicons-network-3',
                'link' => $url('admin', ['action'=>'liste-galerie'])
            ];
            $items[] = [
                'id' => 'contactEtContactLocalisation',
                'label' => 'Contacts et localisation',
                'icon' => 'dripicons-network-3',
                'link' => $url('admin', ['action'=>'liste-galerie'])
            ];
            $items[] = [
                'id' => 'media',
                'label' => 'Media',
                'icon' => 'dripicons-network-3',
                'link' => $url('admin', ['action'=>'liste-galerie'])
            ];
            $items[] = [
                'id' => 'contactForm',
                'label' => 'Message',
                'icon' => 'dripicons-network-3',
                'link' => $url('messages')
            ];
            $items[] = [
                'id' => 'galerie',
                'label' => 'Galerie',
                'icon' => 'dripicons-network-3',
                'link' => $url('admin', ['action'=>'liste-galerie'])
            ];

            $items[] = [
                'id' => 'parametres',
                'label' => 'Parametres',
                'class' => 'text-white',
                'icon' => 'dripicons-network-3',
                'link' => $url('parametres')
            ];

            

            
            /*
            $materielDropdownItems[] = [
                'id' => 'materiel',
                'label' => 'Charger des données',
                'icon' => 'dripicons-upload',
                'link' => $url('upload-excel-to-db')
            ];

            $materielDropdownItems[] = [
                'id' => 'materiel',
                'label' => 'Bordereau - Détails Matériels',
                'icon' => 'dripicons-device-tablet',
                'link' => $url('detailsTypeMaterielUcPc')
            ];*/

            /*$materielDropdownItems[] = [
                'id' => 'materiel',
                'label' => 'Bordereau - Détails Matériels Autres',
                'icon' => 'dripicons-network-3',
                'link' => $url('detailsTypeMaterielAutres')
            ];*/
            
            /***
            $materielDropdownItems[] = [
                'id' => 'materiel',
                'label' => 'Unité Centrale',
                'icon' => 'dripicons-device-tablet',
                'link' => $url('ordinateurs')
            ];

            $materielDropdownItems[] = [
                'id' => 'materiel',
                'label' => 'Ordinateur Portable',
                'icon' => 'dripicons-user-id',
                'link' => $url('pcs')
            ];
            
            $materielDropdownItems[] = [
                'id' => 'materiel',
                'label' => 'Imprimantes',
                'icon' => 'dripicons-print',
                'link' => $url('imprimantes')
            ];
            
            $materielDropdownItems[] = [
                'id' => 'materiel',
                'label' => 'Photocopieuse',
                'icon' => 'dripicons-print',
                'link' => $url('photocopieuses')
            ];
            ***/
            /*
            $materielDropdownItems[] = [
                'id' => 'materiel',
                'label' => 'Disques durs',
                'icon' => 'feather-hard-drive',
                'link' => $url('disquedurs')
            ];

            $materielDropdownItems[] = [
                'id' => 'materiel',
                'label' => 'Routeur',
                'icon' => 'feather-hard-drive',
                'link' => $url('routiers')
            ];

            $materielDropdownItems[] = [
                'id' => 'materiel',
                'label' => 'Clavier',
                'icon' => 'feather-hard-drive',
                'link' => $url('claviers')
            ];

            $materielDropdownItems[] = [
                'id' => 'materiel',
                'label' => 'Souris',
                'icon' => 'feather-hard-drive',
                'link' => $url('souris')
            ];
            
            
            
            */

            /***
            $materielDropdownItems[] = [
                'id' => 'materiel',
                'label' => 'Switch',
                'icon' => 'dripicons-network-3',
                'link' => $url('switchs')
            ];

            $materielDropdownItems[] = [
                'id' => 'materiel',
                'label' => 'Ecran',
                'icon' => 'dripicons-monitor',
                'link' => $url('ecrans')
            ];

            $materielDropdownItems[] = [
                'id' => 'materiel',
                'label' => 'Ecran de surveillance',
                'icon' => 'dripicons-device-desktop',
                'link' => $url('ess')
            ];

            $materielDropdownItems[] = [
                'id' => 'materiel',
                'label' => 'Scanner',
                'icon' => 'dripicons-print',
                'link' => $url('scanners')
            ];

            $materielDropdownItems[] = [
                'id' => 'materiel',
                'label' => 'Stabilisateur',
                'icon' => 'dripicons-toggles',
                'link' => $url('stabilisateurs')
            ];

            $materielDropdownItems[] = [
                'id' => 'materiel',
                'label' => 'Onduleur',
                'icon' => 'dripicons-vibrate',
                'link' => $url('onduleurs')
            ];

            $materielDropdownItems[] = [
                'id' => 'materiel',
                'label' => 'IP Phone',
                'icon' => 'dripicons-phone',
                'link' => $url('ipphones')
            ];

            $materielDropdownItems[] = [
                'id' => 'materiel',
                'label' => 'Borne Wifi',
                'icon' => 'dripicons-wifi',
                'link' => $url('bornewifis')
            ];

            $materielDropdownItems[] = [
                'id' => 'materiel',
                'label' => 'Boitier Switch',
                'icon' => 'dripicons-network-1',
                'link' => $url('boitierswitchs')
            ];
            ***/
            
           /* $items[] = [
                'id' => 'materiel',
                'label' => 'Matériels',
                'icon' => 'feather-server',
                'link' => $url('materiels'),
                'dropdown' => $materielDropdownItems
            ];  */
            
            /*$demandeDropdownItems[] = [
                'id' => 'demande',
                'label' => 'Liste des demandes',
                'icon' => 'feather-hard-drive',
                'link' => $url('demandes')
            ];
            
            $demandeDropdownItems[] = [
                'id' => 'demande',
                'label' => 'Mes demandes',
                'icon' => 'dripicons-network-3',
                'link' => $url('demandes', ['action'=>'mes-demandes'])
            ];*/
            
            /*$demandeDropdownItems[] = [
                'id' => 'demande',
                'label' => 'Nouvelle demande',
                'icon' => 'dripicons-network-3',
                'link' => $url('demandes', ['action'=>'nouvelle-demande'])
            ];*/
            
            /*$items[] = [
                'id' => 'demande',
                'label' => 'Demandes de matériel',
                'icon' => 'feather-server',
                'dropdown' => $demandeDropdownItems
            ];
            
            $besoinDropdownItems[] = [
                'id' => 'besoin',
                'label' => 'Liste des besoins',
                'icon' => 'feather-hard-drive',
                'link' => $url('besoins')
            ];
            
            $besoinDropdownItems[] = [
                'id' => 'besoin',
                'label' => 'Mes besoins',
                'icon' => 'dripicons-network-3',
                'link' => $url('demandes', ['action'=>'mes-demandes'])
            ];
            
            $besoinDropdownItems[] = [
                'id' => 'besoin',
                'label' => 'Exprimer un besoin',
                'icon' => 'dripicons-network-3',
                'link' => $url('besoins', ['action'=>'exprimer-besoin'])
            ];
            
            $items[] = [
                'id' => 'besoin',
                'label' => 'Bésoins exprimés',
                'icon' => 'feather-server',
                'dropdown' => $besoinDropdownItems
            ];

            $items[] = [
                'id' => 'statistiques',
                'label' => 'Statistiques',
                'icon' => 'feather-settings',
                'link'  => '',

            ];

            $items[] = [
                'id' => 'paramètres',
                'label' => 'Paramètres généraux',
                'icon' => 'feather-settings',
                'link'  => $url('application', ['action'=>'parametres-generaux']),

            ];*/

            
            
           
            // Determine which items must be displayed in Admin dropdown.
            /*$adminDropdownItems = [];
            
            if ($this->rbacManager->isGranted(null, 'user.manage')) {
                $adminDropdownItems[] = [
                            'id' => 'users',
                            'label' => 'Gestion des utilisateurs',
                            'icon' => 'fa fa-users',
                            'link' => $url('users')
                        ];
            }
            
            if ($this->rbacManager->isGranted(null, 'permission.manage')) {
                $adminDropdownItems[] = [
                            'id' => 'permissions',
                            'label' => 'Gestion des permissions',
                            'icon' => 'fa fa-ban',
                            'link' => $url('permissions')
                        ];
            }
            
            if ($this->rbacManager->isGranted(null, 'role.manage')) {
                $adminDropdownItems[] = [
                            'id' => 'roles',
                            'label' => 'Gestion des rôles',
                            'icon' => 'notika-icon notika-house',
                            'link' => $url('roles')
                        ];
            }
            
            if (count($adminDropdownItems)!=0) {
                $items[] = [
                    'id' => 'admin',
                    'label' => 'Admin',
                    'icon' => 'fa fa-gears',
                    'link' => 'admin',
                    'dropdown' => $adminDropdownItems
                ];
            }*/
            /*
            $items[] = [
                'id' => 'logout',
                'label' => $this->authService->getIdentity(),
                'float' => 'right',
                'link' => 'logout',
                'icon' => 'notika-icon notika-house',
                'dropdown' => [
                    [
                        'id' => 'settings',
                        'label' => 'Settings',
                        'icon' => 'notika-icon notika-house',
                        'link' => $url('application', ['action'=>'settings'])
                    ],
                    [
                        'id' => 'logout',
                        'label' => 'Sign out',
                        'icon' => 'notika-icon notika-house',
                        'link' => $url('logout')
                    ],
                ]
            ];
            */
        
        
        return $items;
    }
}



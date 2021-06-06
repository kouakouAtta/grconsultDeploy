<?php
namespace Admin\View\Helper;

use Laminas\View\Helper\AbstractHelper;
use Admin\Entity\User;
use Admin\Entity\Salarie;

/**
 * This view helper class displays a menu bar.
 */
class Menu extends AbstractHelper 
{
    /**
     * Menu items array.
     * @var array 
    */
    protected $items = [];
    
    /**
     * Authentication service.
     * @var Laminas\Authentication\AuthenticationService 
     */
    private $authService;
    
    /**
     * Logged in user.
     * @var User\Entity\User
     */
    private $user = null;
    
    /**
     * Active item's ID.
     * @var string  
     */
    protected $activeItemId = '';
    
    protected $activeDropdownItemId = '';
    
    protected $dataTableAssets = false;
    
    /**
     * Constructor.
     * @param array $items Menu items.
     */
    public function __construct($entityManager, $authService, $items=[]) 
    {
        $this->entityManager = $entityManager;
        $this->authService = $authService;
        $this->items = $items;
    }
    
    /**
     * Sets menu items.
     * @param array $items Menu items.
     */
    public function setItems($items) 
    {
        $this->items = $items;
    }
    
    /**
     * Sets ID of the active items.
     * @param string $activeItemId
     */
    public function setActiveItemId($activeItemId) 
    {
        $this->activeItemId = $activeItemId;
    }
    
    function setActiveDropdownItemId($activeDropdownItemId) {
        $this->activeDropdownItemId = $activeDropdownItemId;
    }
    
    function getDataTableAssets() {
        return $this->dataTableAssets;
    }

        
    function setDataTableAssets($dataTableAssets) {
        $this->dataTableAssets = $dataTableAssets;
    }
    
    public function getConnectedUser($useCachedUser = true){
        // If current user is already fetched, return it.
        if ($useCachedUser && $this->user!==null)
            return $this->user;
        
        // Check if user is logged in.
        if ($this->authService->hasIdentity()) {
            
            // Fetch User entity from database.
            $this->user = $this->entityManager->getRepository(User::class)
                    ->findOneByEmail($this->authService->getIdentity());
            if ($this->user==null) {
                // Oops.. the identity presents in session, but there is no such user in database.
                // We throw an exception, because this is a possible security problem. 
                throw new \Exception('Aucun utilisateur ne correspond à cet email.');
            }
            
            
            
            // Return found User.
            return $this->user;
        }
    }
  
    /**
     * Renders the mobile menu.
     * @return string HTML code of the menu.
    */
    public function mobileRender() 
    {
        if (count($this->items)==0)
            return ''; // Do nothing if there are no items.
        
        $result = '<ul class="metismenu list-unstyled" id="side-menu">';
        $result .= '<li class="menu-title">Menu</li>';
        $result .= '<li>';
        $result .= '<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">';
        $result .= '<div class="mobile-menu">';
        $result .= '<nav id="dropdown">';
        $result .= '<ul class="mobile-menu-nav">';
        
        $result .= '<span class="icon-bar"></span>';
        $result .= '</button>';
        $result .= '</div>';
        
        $result .= '<div class="collapse navbar-collapse navbar-ex1-collapse">';        
        $result .= '<ul class="nav navbar-nav">';
        
        // Render items
        foreach ($this->items as $item) {
            if(!isset($item['float']) || $item['float']=='left')
                $result .= $this->renderItem($item);
        }
        
        $result .= '</ul>';
        $result .= '<ul class="nav navbar-nav navbar-right">';
        
        // Render items
        foreach ($this->items as $item) {
            if(isset($item['float']) && $item['float']=='right')
                $result .= $this->renderItem($item);
        }
        
        $result .= '</ul>';
        $result .= '</div>';
        $result .= '</nav>';
        
        return $result;   
    }
    
    /**
     * Renders the main menu.
     * @return string HTML code of the menu.
    */
    public function render() 
    {
        if (count($this->items)==0)
            return ''; // Do nothing if there are no items.
        
       
        $result= '<ul class="metismenu list-unstyled" id="side-menu">';
        $result .= '<li class="menu-title">Menu</li>';
        // Render items
        foreach ($this->items as $item) {
            $result .= $this->renderItem($item);
        }
        $result.= '</ul>';
        
        return $result;   
    }
    
    /**
     * Renders an item.
     * @param array $item The menu item info.
     * @return string HTML code of the item.
     */
    protected function renderItem($item) 
    {
        $id = isset($item['id']) ? $item['id'] : '';
        $isActive = ($id==$this->activeItemId);
        $label = isset($item['label']) ? $item['label'] : '';
        $icon = $item['icon'];
        $target = isset($item['target']) ? 'target = _blank' : '';
             
        $result = ''; 
     
        $escapeHtml = $this->getView()->plugin('escapeHtml');
        
               
        $link = isset($item['link']) ? $item['link'] : '#';
         
        if (isset($item['dropdown'])) {
            
            $dropdownItems = $item['dropdown'];
            
            $result .= $isActive?'<li class="mm-active">':'<li>';
            $result .= $isActive?'<a class="has-arrow waves-effect active" ':'<a class="has-arrow waves-effect" ';
            $result .=isset($item['link'])?'href="' . $escapeHtml($link) . '">':'href="javascript:void(0);">';
            $result .='<i class="' . $escapeHtml($icon) . '"></i><span>' . $escapeHtml($label) . '</span></a>';
            $result .= $isActive?'<ul class="submenu mm-collapse mm-show" aria-expanded="false">':'<ul class="submenu mm-collapse" aria-expanded="false">';
            foreach ($dropdownItems as $item) {
                $isItemActive = ($id==$this->activeDropdownItemId);
                $link = isset($item['link']) ? $item['link'] : '#';
                $label = isset($item['label']) ? $item['label'] : '';
                $icon = $item['icon'];
                
                $result .= $isItemActive?'<li class="mm-active">':'<li>';
                $result .= $isItemActive?'<a class="active"':'<a ';
                $result .= 'href="' . $escapeHtml($link) . '"><i style="font-size:14px;" class="' . $escapeHtml($icon) . '"></i><span>'.$escapeHtml($label).'</a></li>';
            }
            $result .= '</ul>';
            $result .= '</li>';
            
        } else {
            $result .= $isActive?'<li class="mm-active">':'<li>';
            $result .= $isActive?'<a class="waves-effect active"':'<a '. $target.' class="waves-effect"';
            $result .='href="' . $escapeHtml($link) .'"><i class="' . $escapeHtml($icon) . '"></i><span>' . $escapeHtml($label) . '</span></a>';
            
        }
        $result .= '</li>';
        
    
        return $result;
    }
    
    protected function renderItemDetails($item) 
    {
        
        
        $label = isset($item['label']) ? $item['label'] : '';
        $link = isset($item['link']) ? $item['link'] : '#';
             
        $result = ''; 
     
        $escapeHtml = $this->getView()->plugin('escapeHtml');
        
        if (isset($item['dropdown'])) {
            
            $dropdownItems = $item['dropdown'];
            
            $result .= '<div id="'.$escapeHtml($link).'" class="tab-pane in active notika-tab-menu-bg animated flipInX">';
            $result .= '<ul class="notika-main-menu-dropdown">';
                foreach ($dropdownItems as $item) {
                    $link = isset($item['link']) ? $item['link'] : '#';
                    $label = isset($item['label']) ? $item['label'] : '';


                    $result .= '<li>';
                    $result .= '<a href="'.$escapeHtml($link).'">'.$escapeHtml($label).'</a>';
                    $result .= '</li>';
                }
            $result .= '</ul>';
            $result .= '</div>';
            
        }
    
        return $result;
    }
}

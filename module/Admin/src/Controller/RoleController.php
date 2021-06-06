<?php
namespace Admin\Controller;

use Laminas\Mvc\Controller\AbstractActionController;
use Laminas\View\Model\ViewModel;
use Admin\Entity\Role;
use Admin\Entity\Permission;
use Admin\Form\RoleForm;
use Admin\Form\RolePermissionsForm;

/**
 * This controller is responsible for role management (adding, editing, 
 * viewing, deleting).
 */
class RoleController extends AbstractActionController 
{
    /**
     * Entity manager.
     * @var Doctrine\ORM\EntityManager
     */
    private $entityManager;
    
    /**
     * Role manager.
     * @var User\Service\RoleManager 
     */
    private $roleManager;
    
    /**
     * Constructor. 
     */
    public function __construct($entityManager, $roleManager)
    {
        $this->entityManager = $entityManager;
        $this->roleManager = $roleManager;
    }
    
    /**
     * This is the default "index" action of the controller. It displays the 
     * list of roles.
     */
    public function indexAction() 
    {
        $roles = $this->entityManager->getRepository(Role::class)
                ->findBy([], ['id'=>'ASC']);
        
        return new ViewModel([
            'roles' => $roles
        ]);
    } 
    
    /**
     * This action displays a page allowing to add a new role.
     */
    public function ajouterAction()
    {
        // Create form
        $form = new RoleForm('create', $this->entityManager);
        
        $roleList = [];
        $roles = $this->entityManager->getRepository(Role::class)
                ->findBy([], ['name'=>'ASC']);
        foreach ($roles as $role) {
            $roleList[$role->getId()] = $role->getName();
        }
        $form->get('inherit_roles')->setValueOptions($roleList);
        
        // Check if user has submitted the form
        if ($this->getRequest()->isPost()) {
            
            // Fill in the form with POST data
            $data = $this->params()->fromPost();            
            
            $form->setData($data);
            
            // Validate form
            if($form->isValid()) {
                
                // Get filtered and validated data
                $data = $form->getData();
                
                // Add role.
                $this->roleManager->addRole($data);
                
                // Add a flash message.
                $this->flashMessenger()->addSuccessMessage('Le rôle est ajouté avec succès.');
                
                // Redirect to "index" page
                return $this->redirect()->toRoute('roles', ['action'=>'index']);                
            }               
        } 
        
        return new ViewModel([
                'form' => $form
            ]);
    }
    
    /**
     * The "view" action displays a page allowing to view role's details.
     */
    public function voirDetailsAction() 
    {
        $id = (int)$this->params()->fromRoute('id', -1);
        if ($id<1) {
            $this->getResponse()->setStatusCode(404);
            return;
        }
        
        // Find a role with such ID.
        $role = $this->entityManager->getRepository(Role::class)
                ->find($id);
        
        if ($role == null) {
            $this->getResponse()->setStatusCode(404);
            return;
        }
        
        $allPermissions = $this->entityManager->getRepository(Permission::class)
                ->findBy([], ['name'=>'ASC']);
        
        $effectivePermissions = $this->roleManager->getEffectivePermissions($role);
                
        return new ViewModel([
            'role' => $role,
            'allPermissions' => $allPermissions,
            'effectivePermissions' => $effectivePermissions
        ]);
    }
    
    /**
     * This action displays a page allowing to edit an existing role.
     */
    public function modifierAction()
    {
        $id = (int)$this->params()->fromRoute('id', -1);
        if ($id<1) {
            $this->getResponse()->setStatusCode(404);
            return;
        }
        
        $role = $this->entityManager->getRepository(Role::class)
                ->find($id);
        
        if ($role == null) {
            $this->getResponse()->setStatusCode(404);
            return;
        }
        
        // Create form
        $form = new RoleForm('update', $this->entityManager, $role);
        
        $roleList = [];
        $selectedRoles = [];
        $roles = $this->entityManager->getRepository(Role::class)
                ->findBy([], ['name'=>'ASC']);
        foreach ($roles as $role2) {
            
            if ($role2->getId()==$role->getId())
                continue; // Do not inherit from ourselves
            
            $roleList[$role2->getId()] = $role2->getName();
            
            if ($role->hasParent($role2))
                $selectedRoles[] = $role2->getId();
        }
        $form->get('inherit_roles')->setValueOptions($roleList);
        
        $form->get('inherit_roles')->setValue($selectedRoles);
        
        // Check if user has submitted the form
        if ($this->getRequest()->isPost()) {
            
            // Fill in the form with POST data
            $data = $this->params()->fromPost();            
            
            $form->setData($data);
            
            // Validate form
            if($form->isValid()) {
                
                // Get filtered and validated data
                $data = $form->getData();
                
                // Update permission.
                $this->roleManager->updateRole($role, $data);
                
                // Add a flash message.
                $this->flashMessenger()->addSuccessMessage('Le rôle a été modifié avec succès.');
                
                // Redirect to "index" page
                return $this->redirect()->toRoute('roles', ['action'=>'index']);                
            }               
        } else {
            $form->setData(array(
                    'name'=>$role->getName(),
                    'description'=>$role->getDescription()     
                ));
        }
        
        return new ViewModel([
                'form' => $form,
                'role' => $role
            ]);
    }
    
    /**
     * The "editPermissions" action allows to edit permissions assigned to the given role.
     */
    public function editerPermissionsAction()
    {
        $id = (int)$this->params()->fromRoute('id', -1);
        if ($id<1) {
            $this->getResponse()->setStatusCode(404);
            return;
        }
        
        $role = $this->entityManager->getRepository(Role::class)
                ->find($id);
        
        if ($role == null) {
            $this->getResponse()->setStatusCode(404);
            return;
        }
            
        $allPermissions = $this->entityManager->getRepository(Permission::class)
                ->findBy([], ['name'=>'ASC']);
        
        $effectivePermissions = $this->roleManager->getEffectivePermissions($role);
            
        // Create form
        $form = new RolePermissionsForm($this->entityManager);
        foreach ($allPermissions as $permission) {
            $label = $permission->getName();
            $isDisabled = false;
            if (isset($effectivePermissions[$permission->getName()]) && $effectivePermissions[$permission->getName()]=='inherited') {
                $label .= ' (inherited)';
                $isDisabled = true;
            }
            $form->addPermissionField($permission->getName(), $label, $isDisabled);
        }
        
        // Check if user has submitted the form
        if ($this->getRequest()->isPost()) {
            
            // Fill in the form with POST data
            $data = $this->params()->fromPost();            
            
            $form->setData($data);
            
            // Validate form
            if($form->isValid()) {
                
                // Get filtered and validated data
                $data = $form->getData();
                
                // Update permissions.
                $this->roleManager->updateRolePermissions($role, $data);
                
                // Add a flash message.
                $this->flashMessenger()->addSuccessMessage('Les permissions ont été mises à jour.');
                
                // Redirect to "index" page
                return $this->redirect()->toRoute('roles', ['action'=>'voir-details', 'id'=>$role->getId()]);                
            }
        } else {
        
            $data = [];
            foreach ($effectivePermissions as $name=>$inherited) {
                $data['permissions'][$name] = 1;
            }
            
            $form->setData($data);
        }
        
        $errors = $form->getMessages();
        
        return new ViewModel([
                'form' => $form,
                'role' => $role,
                'allPermissions' => $allPermissions,
                'effectivePermissions' => $effectivePermissions
            ]);
    }

    /**
     * This action deletes a permission.
     */
    public function supprimerAction()
    {
        $id = (int)$this->params()->fromRoute('id', -1);
        if ($id<1) {
            $this->getResponse()->setStatusCode(404);
            return;
        }
        
        $role = $this->entityManager->getRepository(Role::class)
                ->find($id);
        
        if ($role == null) {
            $this->getResponse()->setStatusCode(404);
            return;
        }
        
        // Delete role.
        $this->roleManager->deleteRole($role);
        
        // Add a flash message.
        $this->flashMessenger()->addSuccessMessage('Le rôle a été supprimé');

        // Redirect to "index" page
        return $this->redirect()->toRoute('roles', ['action'=>'index']); 
    }
}





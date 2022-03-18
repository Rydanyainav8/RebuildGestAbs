<?php

namespace App\Controller;

use App\Entity\Etudiant;
use App\Entity\Module;
use App\Entity\Prof;
use App\Form\EditEtudiantType;
use App\Form\EditProfType;
use App\Form\EtudiantType;
use App\Form\ModuleType;
use App\Form\ProfType;
use App\Form\SearchEtudiantType;
use App\Repository\AbsEtudiantRepository;
use App\Repository\EtudiantRepository;
use App\Repository\ModuleRepository;
use App\Repository\ProfRepository;
use App\Repository\RetardEtudiantRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\String\Slugger\SluggerInterface;
use Doctrine\Persistence\ManagerRegistry as PersistenceManagerRegistry;

class AdminController extends AbstractController
{
    #[Route('/Admin', name: 'app_admin')]
    public function index(): Response
    {
        return $this->redirectToRoute('indexEtudiant');
    }

    #[Route('/Admin/create/etudiant', name: 'createEtudiant')]
    public function createEtudiant(Request $req, UserPasswordHasherInterface $hasher, EntityManagerInterface $em, SluggerInterface $slugger): Response
    {

        ////////////////////////CRUD ETUDIANT//////////////////////////////////////


        $etudiant = new Etudiant();
        $form = $this->createForm(EtudiantType::class, $etudiant);

        $form->handleRequest($req);

        if ($form->isSubmitted() && $form->isValid()) {
            $pdp = $form['pdp']->getData();
            if ($pdp) {
                $originalFileName = pathinfo($pdp->getClientOriginalName(), PATHINFO_FILENAME);
                $safeFileName = $slugger->slug($originalFileName);
                $newFileName = $safeFileName . '-' . uniqid() . '-' . $pdp->guessExtension();

                $pdp->move(
                    $this->getParameter('pdp_directory'),
                    $newFileName
                );
                $etudiant->setPhoto($newFileName);
            }
            $hash = $hasher->hashPassword($etudiant, $etudiant->getPassword());
            $etudiant->setPassword($hash);
            $etudiant->setRoles(['ROLE_STUDENT']);
            $em->persist($etudiant);
            $em->flush();
            return $this->redirectToRoute('indexEtudiant');
        }

        return $this->render('admin/etudiant/create.html.twig', [
            'form' => $form->createView()
        ]);
    }

    #[Route('/Admin/indexEt', name: 'indexEtudiant')]
    public function indexEtudiant(EtudiantRepository $etudiantRepo, Request $req): Response
    {

        $limit = 40;
        $page = (int)$req->query->get('page', 1);
        $etudiants = $etudiantRepo->getPaginatedEtudiant($page, $limit);
        $total = $etudiantRepo->getTotalEtudiant();
        $form = $this->createForm(SearchEtudiantType::class);
        $search = $form->handleRequest($req);

        if ($form->isSubmitted() && $form->isValid()) {
            $etudiants = $etudiantRepo->SearchEtudiant($search->get('mots')->getData());
            if ($etudiants == null) {
                $this->addFlash('message', 'Etudiant not found');
            }
        }
        $form = $form->createView();

        // $etudiants = $etudiantRepo->findAll();

        return $this->render('admin/etudiant/index.html.twig', compact('etudiants', 'limit', 'page', 'total', 'form'));
    }

    #[Route('/Admin/editEt/{id}', name:'editEtudiant')]
    public function editEtudiant(Etudiant $etudiant, Request $req, EntityManagerInterface $em, SluggerInterface $slugger)
    {
        $form = $this->createForm(EditEtudiantType::class, $etudiant);
        $form->handleRequest($req);
        $Vimg = $etudiant->getPhoto();
        if ($form->isSubmitted() && $form->isValid()) 
        {
            $pdp = $form['pdp']->getData();
            if ($pdp) 
            {
                $originalFileName = pathinfo($pdp->getClientOriginalName(), PATHINFO_FILENAME);
                $safeFileName = $slugger->slug($originalFileName);
                $newFileName = $safeFileName . '-' . uniqid() . '-' . $pdp->guessExtension();
                
                $pdp->move(
                    $this->getParameter('pdp_directory'),
                    $newFileName
                );
                $etudiant->setPhoto($newFileName);
            }
            $em->persist($etudiant);
            $em->flush();
            return $this->redirectToRoute('indexEtudiant');
        }

        return $this->render('admin/etudiant/edit.html.twig',[
            'form' => $form->createView(),
            'Vimg' => $Vimg
        ]);
    }

    #[Route('/Admin/deleteEtudiant/{id}', name:'deleteEtudiant')]
    public function deleteEt(Etudiant $etudiant, PersistenceManagerRegistry $doctrine)
    {
        $em = $doctrine->getManager();
        $em->remove($etudiant);
        $em->flush();
        return $this->redirectToRoute('indexEtudiant');
    }   

    ////////////////////////////////////CRUD PROF///////////////////////////////////////

    #[Route('/Admin/createProf', name:'createProf')]
    public function createProf(Request $req, UserPasswordHasherInterface $hasher, EntityManagerInterface $em, SluggerInterface $slugger): Response
    {
        $prof = new Prof();
        $form = $this->createForm(ProfType::class, $prof);

        $form->handleRequest($req);

        if ($form->isSubmitted() && $form->isValid()) 
        {
            $pdp = $form['pdp']->getData();
            if ($pdp) 
            {
                $originalFileName = pathinfo($pdp->getClientOriginalName(), PATHINFO_FILENAME);
                $safeFileName = $slugger->slug($originalFileName);
                $newFileName = $safeFileName . '-' . uniqid() . '-' . $pdp->guessExtension();
                
                $pdp->move(
                    $this->getParameter('pdp_directory'),
                    $newFileName
                );
                $prof->setPhoto($newFileName);
            }

            $hash = $hasher->hashPassword($prof, $prof->getPassword());
            $prof->setPassword($hash);
            $prof->setRoles(['ROLE_ENS']);
            $em->persist($prof);
            $em->flush();
            return $this->redirectToRoute('indexProf');
        }

        return $this->render('admin/prof/create.html.twig',[
            'form' => $form->createView()
        ]);
    }

    #[Route('Admin/indexProf', name:'indexProf')]
    public function indexProf(ProfRepository $profRepo): Response
    {
        $profs = $profRepo->findAll();
        return $this->render('admin/prof/index.html.twig', compact('profs'));
    }

    #[Route('admin/editProf/{id}', name:'editProf')]
    public function editProf(Prof $prof, Request $req, EntityManagerInterface $em, SluggerInterface $slugger)
    {
        $form = $this->createForm(EditProfType::class, $prof);
        $form->handleRequest($req);
        $Vimg = $prof->getPhoto();
        if ($form->isSubmitted() && $form->isValid()) 
        {
            $pdp = $form['pdp']->getData();
            if ($pdp) 
            {
                $originalFileName = pathinfo($pdp->getClientOriginalName(), PATHINFO_FILENAME);
                $safeFileName = $slugger->slug($originalFileName);
                $newFileName = $safeFileName . '-' . uniqid() . '-' . $pdp->guessExtension();
                
                $pdp->move(
                    $this->getParameter('pdp_directory'),
                    $newFileName
                );
                $prof->setPhoto($newFileName);
            }
            $em->persist($prof);
            $em->flush();
            return $this->redirectToRoute('indexProf');
        }

        return $this->render('admin/prof/edit.html.twig',[
            'form' => $form->createView(),
            'Vimg' => $Vimg
        ]);
    }

    #[Route('Admin/deleteProf/{id}', name:'deleteProf')]
    public function deleteProf(Prof $prof, PersistenceManagerRegistry $doctrine)
    {
        $em = $doctrine->getManager();
        $em->remove($prof);
        $em->flush();
        return $this->redirectToRoute('indexProf');
    }

    ////////////////////////CRUD MODULE//////////////////////////

    #[Route('admin/createModule', name:'createModule')]
    public function createModule(Request $req, EntityManagerInterface $em): Response
    {
        $module = new Module();
        $form = $this->createForm(ModuleType::class, $module);
        $form->handleRequest($req);

        if ($form->isSubmitted() && $form->isValid()) 
        {
            $this->addFlash('success', 'Module ajoutée');
            $em->persist($module);
            $em->flush();
        }
        return $this->render('admin/module/create.html.twig', [
            'form' => $form->createView()
        ]);
    }

    
    #[Route('Admin/indexModule', name: 'indexModule')]
    public function indexModule(ModuleRepository $moduleRepo): Response
    {
        $modules = $moduleRepo->findAll();
        return $this->render('admin/module/index.html.twig', compact('modules'));
    }

    #[Route('admin/edtiModule/{id}', name:'editModule')]
    public function editModule(Module $module, Request $req, EntityManagerInterface $em)
    {
        $form = $this->createForm(ModuleType::class, $module);
        $form->handleRequest($req);

        if ($form->isSubmitted() && $form->isValid()) 
        {
            $em->persist($module);
            $em->flush();
            return $this->redirectToRoute('indexModule');
        }
        return $this->render('admin/module/edit.html.twig',[
            'form' => $form->createView(),
        ]);
    }

    /////////////////STATISTIQUE//////////////////////

    #[Route('/Admin/stat/', name: 'adminstat_index')]
    public function statindex(EtudiantRepository $etudiantRepo): Response
    {
        $etudiants = $etudiantRepo->findAll();
        return $this->render('admin/statistique/index.html.twig', compact('etudiants'));
    }

    #[Route('/Admin/statEtudiant/{id}', name: 'admin_statEtudiant')]
    public function statAbsEtudiant($id, Etudiant $etudiant, AbsEtudiantRepository $AbsEtudiantRepo, RetardEtudiantRepository $retEtRepo): Response
    {
        // $etudiantMonthStats = $AbsEtudiantRepo->getEtudiantByEmail($id);
        // $NbAbsBy12Months = $AbsEtudiantRepo->CurrentMonthCountAbs($id);
        // $NbAbsByYear = $AbsEtudiantRepo->YearCountAbs($id);

                /////////12 Months///////
        $JanAbs = $AbsEtudiantRepo->JanAbs($id);
        $FebAbs = $AbsEtudiantRepo->FebAbs($id);
        $MarAbs = $AbsEtudiantRepo->MarAbs($id);
        $AvrAbs = $AbsEtudiantRepo->AvrAbs($id);
        $MaiAbs = $AbsEtudiantRepo->MaiAbs($id);
        $JunAbs = $AbsEtudiantRepo->JunAbs($id);
        $JulAbs = $AbsEtudiantRepo->JulAbs($id);
        $AouAbs = $AbsEtudiantRepo->AouAbs($id);
        $SepAbs = $AbsEtudiantRepo->SepAbs($id);
        $OctAbs = $AbsEtudiantRepo->OctAbs($id);
        $NovAbs = $AbsEtudiantRepo->NovAbs($id);
        $DecAbs = $AbsEtudiantRepo->DecAbs($id);

                /////////7 Weeks///////
        $MonAbs = $AbsEtudiantRepo->MonAbs($id);
        $TueAbs = $AbsEtudiantRepo->TueAbs($id);
        $WedAbs = $AbsEtudiantRepo->WedAbs($id);
        $ThuAbs = $AbsEtudiantRepo->ThuAbs($id);
        $FriAbs = $AbsEtudiantRepo->FriAbs($id);
        $SatAbs = $AbsEtudiantRepo->SatAbs($id);

                ///////////RETARD////////
        
                          /////////12 Months///////
        $JanRet = $retEtRepo->JanRet($id);
        $FevRet = $retEtRepo->FevRet($id);
        $MarRet = $retEtRepo->MarRet($id);
        $AvrRet = $retEtRepo->AvrRet($id);
        $MaiRet = $retEtRepo->MaiRet($id);
        $JunRet = $retEtRepo->JunRet($id);
        $JulRet = $retEtRepo->JulRet($id);
        $AouRet = $retEtRepo->AouRet($id);
        $SepRet = $retEtRepo->SepRet($id);
        $OctRet = $retEtRepo->OctRet($id);
        $NovRet = $retEtRepo->NovRet($id);
        $DecRet = $retEtRepo->DecRet($id);

                /////////7 Weeks///////
        $MonRet = $retEtRepo->MonRet($id);
        $TueRet = $retEtRepo->TueRet($id);
        $WedRet = $retEtRepo->WedRet($id);
        $ThuRet = $retEtRepo->ThuRet($id);
        $FriRet = $retEtRepo->FriRet($id);
        $SatRet = $retEtRepo->SatRet($id);

        // $username = $etudiantRepo->getusername($id);
        $username = $etudiant->getEmail();
        $photo = $etudiant->getPhoto();
    
        return $this->render('admin/statistique/etudiant/Stat.html.twig', [
            'JanAbs' => json_encode($JanAbs),
            'FebAbs' => json_encode($FebAbs),
            'MarAbs' => json_encode($MarAbs),
            'AvrAbs' => json_encode($AvrAbs),
            'MaiAbs' => json_encode($MaiAbs),
            'JunAbs' => json_encode($JunAbs),
            'JulAbs' => json_encode($JulAbs),
            'AouAbs' => json_encode($AouAbs),
            'SepAbs' => json_encode($SepAbs),
            'OctAbs' => json_encode($OctAbs),
            'NovAbs' => json_encode($NovAbs),
            'DecAbs' => json_encode($DecAbs),
            'MonAbs' => json_encode($MonAbs),
            'TueAbs' => json_encode($TueAbs),
            'WedAbs' => json_encode($WedAbs),
            'ThuAbs' => json_encode($ThuAbs),
            'FriAbs' => json_encode($FriAbs),
            'SatAbs' => json_encode($SatAbs),
            'JanRet' => json_encode($JanRet),
            'FebRet' => json_encode($FevRet),
            'MarRet' => json_encode($MarRet),
            'AvrRet' => json_encode($AvrRet),
            'MaiRet' => json_encode($MaiRet),
            'JunRet' => json_encode($JunRet),
            'JulRet' => json_encode($JulRet),
            'AouRet' => json_encode($AouRet),
            'SepRet' => json_encode($SepRet),
            'OctRet' => json_encode($OctRet),
            'NovRet' => json_encode($NovRet),
            'DecRet' => json_encode($DecRet),
            'MonRet' => json_encode($MonRet),
            'TueRet' => json_encode($TueRet),
            'WedRet' => json_encode($WedRet),
            'ThuRet' => json_encode($ThuRet),
            'FriRet' => json_encode($FriRet),
            'SatRet' => json_encode($SatRet),
            'username' => $username,
            'photo' => $photo
        ]);
    }
}

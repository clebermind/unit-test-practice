<?php

namespace App\Controller;

use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;
use App\Service\FilterUsers;
use Symfony\Component\HttpFoundation\Request;
use Exception;

class UserController extends AbstractController
{

    /**
     * @throws Exception
     */
    #[Route('/users', name: 'list_users', methods: ['GET'])]
    public function list(UserRepository $userRepository, Request $request): Response
    {
        $users = $userRepository->findAll();

        $data = [];
        foreach ($users as $user) {
            $data[] = [
                'id' => $user->getId(),
                'name' => $user->getName(),
            ];
        }

        if ($request->get('filter')) {
            $data = $this->filterUsers($data, $request);
        }

        return new JsonResponse($data);
    }

    #[Route('/user/{id}', name: 'user', methods: ['GET'])]
    public function get(int $id, UserRepository $userRepository): Response
    {
        $user = $userRepository->find($id);

        return new JsonResponse([
            'id' => $user->getId(),
            'name' => $user->getName(),
        ]);
    }

    private function filterUsers(array $data, Request $request): array
    {
        $filter = $request->get('filter');
        $filterUsers = $this->getFilterUsers();

        switch ($filter) {
            case 'first-letter':
                $letter = $request->get('letter');
                if (empty($letter)) {
                    throw new Exception('Letter is mandatory when filtering by first letter');
                } elseif (!preg_match('/^[a-zA-Z]+$/', $letter)) {
                    throw new Exception('Letter must be a string');
                } elseif (strlen($letter) > 1) {
                    $letter = $letter[0];
                }
                $data = $filterUsers->filterUsersByFirstLetter($data, $letter);
                break;
            case 'odd':
                $data = $filterUsers->filterUsersByOddId($data);
                break;
            case 'even':
                $data = $filterUsers->filterUsersByEvenId($data);
                break;
            default:
                throw new Exception('Invalid filter value');
        }

        return $data;
    }

    private function getFilterUsers(): FilterUsers
    {
        return new FilterUsers();
    }
}

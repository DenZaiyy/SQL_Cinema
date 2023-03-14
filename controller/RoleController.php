<?php
require_once 'app/DAO.php';

class RoleController
{
    public function listRoles()
    {
        $dao = new DAO();

        $sql = "SELECT id_role, label
                FROM role
                ORDER BY id_role";

        $roles = $dao->executeRequest($sql);
        require 'view/role/listRoles.php';
    }

    public function detailRole($id)
    {
        $dao = new DAO();

        $sql = 'SELECT p.picture, p.lastname, p.firstname
                FROM actor a, person p
                WHERE a.id_person = p.id_person
                AND a.id_actor = :id';

        $sql2 = 'SELECT f.title, r.label, DATE_FORMAT(f.date_release, "%Y") Year
                FROM film f, role r, actor a, person p, casting c
                WHERE a.id_person = p.id_person
                AND c.id_actor = a.id_actor
                AND c.id_film = f.id_film
                AND c.id_role = r.id_role
                AND c.id_actor = :id';

        $params = ['id' => $id];

        $actors = $dao->executeRequest($sql, $params);
        $cast = $dao->executeRequest($sql2, $params);
        require 'view/role/detailRole.php';
    }

    public function formRole()
    {
        require 'view/role/addRole.php';
    }

    public function addRole()
    {
        $dao = new DAO();
        $db = $dao->getBDD();

        if (isset($_POST['submit'])) {
            $label = filter_input(INPUT_POST, "label", FILTER_SANITIZE_FULL_SPECIAL_CHARS);

            if ($label) {

                $sql = "INSERT INTO role (label)
                        VALUES (:label)";

                $params = [
                    'label' => $label
                ];

                $addRole = $dao->executeRequest($sql, $params);

                $id = $db->lastInsertId();
                $this->detailRole($id);

                header('Location: index.php?action=detailRole?id=' . $id);
            }
        } else {
            header('Location: index.php');
        }
    }
}

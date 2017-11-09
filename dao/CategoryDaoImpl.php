<?php

/**
 * Description of CategoryDaoImpl
 *
 * @author Robby
 */
class CategoryDaoImpl {

    public function getAllCategories() {
        $link = PDOUtil::createPDOConnection();
        $query = "SELECT * FROM category";
        $result = $link->query($query);
        $result->setFetchMode(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE,
                'Category');
        PDOUtil::closePDOConnection($link);
        return $result;
    }

    public function getCategoryFromDb($id) {
        /*
         * $link = PDOUtil::createPDOConnection();
          $query = "SELECT u.name, r.name AS role_name FROM user u JOIN role r WHERE u.email = ? AND u.password = PASSWORD(?) LIMIT 1";
          $stmt = $link->prepare($query);
          $stmt->bindValue(1, $user->getEmail(), PDO::PARAM_STR);
          $stmt->bindValue(2, $user->getPassword(), PDO::PARAM_STR);
          $stmt->setFetchMode(PDO::FETCH_OBJ);
          $stmt->execute();
          $result = $stmt->fetch();
          PDOUtil::closePDOConnection($link);
          return $result;
         *
         */

        $link = PDOUtil::createPDOConnection();
        $query = "SELECT * FROM category WHERE id = ? LIMIT 1";
        $stmt = $link->prepare($query);
        $stmt->bindParam(1, $id, PDO::PARAM_INT);
        $stmt->setFetchMode(PDO::FETCH_OBJ);
        $stmt->execute();
        $result = $stmt->fetch();
        PDOUtil::closePDOConnection($link);
        return $result;
    }

    public function addNewCategory(Category $category) {
        $link = PDOUtil::createPDOConnection();
        $query = "INSERT INTO category(name) VALUES(?)";
        $stmt = $link->prepare($query);
        $stmt->bindValue(1, $category->getName(), PDO::PARAM_STR);
        $link->beginTransaction();
        if ($stmt->execute()) {
            $link->commit();
        } else {
            $link->rollBack();
        }
        PDOUtil::closePDOConnection($link);
    }

    public function deleteCategory(Category $category) {
        $link = PDOUtil::createPDOConnection();
        $query = "DELETE FROM category WHERE id = ?";
        $stmt = $link->prepare($query);
        $stmt->bindValue(1, $category->getId(), PDO::PARAM_INT);
        $link->beginTransaction();
        if ($stmt->execute()) {
            $link->commit();
        } else {
            $link->rollBack();
        }
        PDOUtil::closePDOConnection($link);
    }

    public function updateCategory(Category $category) {
        $link = PDOUtil::createPDOConnection();
        $query = "UPDATE category SET name = ? WHERE id = ?";
        $stmt = $link->prepare($query);
        $stmt->bindValue(1, $category->getName(), PDO::PARAM_STR);
        $stmt->bindValue(2, $category->getId(), PDO::PARAM_INT);
        $link->beginTransaction();
        if ($stmt->execute()) {
            $link->commit();
        } else {
            $link->rollBack();
        }
        PDOUtil::closePDOConnection($link);
    }

}

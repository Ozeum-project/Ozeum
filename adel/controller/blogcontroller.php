<?php
include 'C:\xampp\htdocs\ozeum\config.php';
include 'C:\xampp\htdocs\ozeum\adel\model\blog.php';

class BlogController
{
    /**
     * List all blog posts
     * @return array List of blog posts
     */
    public function listPosts()
    {
        $sql = "SELECT * FROM blog";
        $db = config::getConnexion();
        try {
            $liste = $db->query($sql);
            return $liste;
        } catch (Exception $e) {
            die('error : ' . $e->getMessage());
        }
    }

    /**
     * Add a new blog post
     * @param Blog $blog The blog post to add
     */
    function addPost(Blog $blog)
    {
        $sql = "INSERT INTO blog (id, titre, categorie, statut, auteur, date_publication, contenu, thumbnail) 
                VALUES (:id, :titre, :categorie, :statut, :auteur, :date_publication, :contenu, :thumbnail)";
        $db = config::getConnexion();
        try {
            $query = $db->prepare($sql);
            $query->execute([
                'id' => $blog->getId(),
                'titre' => $blog->getTitre(),
                'categorie' => $blog->getCategorie(),
                'statut' => $blog->getStatut(),
                'auteur' => $blog->getAuteur(),
                'date_publication' => $blog->getDatePublication()->format('Y-m-d H:i:s'),
                'contenu' => $blog->getContenu(),
                'thumbnail' => $blog->getThumbnail()
            ]);
        } catch (Exception $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }

    /**
     * Delete a blog post
     * @param int $id The ID of the blog post to delete
     */
    function deletePost($id)
    {
        // Fetch the thumbnail path for deletion if needed
        $sql = "SELECT thumbnail FROM blog WHERE id = ?";
        $db = config::getConnexion();
        $stmt = $db->prepare($sql);
        $stmt->execute([$id]);

        $post = $stmt->fetch();
        if ($post && !empty($post['thumbnail'])) {
            $thumbnailPath = 'E:/xampp/htdocs/2eme esprit/web-project/ghofrane/' . substr($post['thumbnail'], 5);
            
            // Check if the file exists before deleting it
            if (file_exists($thumbnailPath)) {
                unlink($thumbnailPath);  // Delete the thumbnail
                echo "Thumbnail deleted successfully.";
            } else {
                echo "Thumbnail not found.";
                echo $thumbnailPath;
            }
        }

        // Delete the blog post from database
        $sql = "DELETE FROM blog WHERE id = :id";
        $db = config::getConnexion();
        $req = $db->prepare($sql);
        $req->bindValue(':id', $id);

        try {
            $req->execute();
        } catch (Exception $e) {
            die('Error:' . $e->getMessage());
        }
    }

    /**
     * Update a blog post
     * @param Blog $blog The updated blog post data
     * @param int $id The ID of the blog post to update
     */
    function updatePost(Blog $blog, $id)
    {
        try {
            $db = config::getConnexion();

            $query = $db->prepare(
                "UPDATE blog SET 
                    titre = :titre,
                    categorie = :categorie,
                    statut = :statut, 
                    auteur = :auteur,
                    date_publication = :date_publication, 
                    contenu = :contenu,
                    thumbnail = :thumbnail
                WHERE id = :oldid"
            );

            $query->execute([
                'titre' => $blog->getTitre(),
                'categorie' => $blog->getCategorie(),
                'statut' => $blog->getStatut(),
                'auteur' => $blog->getAuteur(),
                'date_publication' => $blog->getDatePublication()->format('Y-m-d H:i:s'),
                'contenu' => $blog->getContenu(),
                'thumbnail' => $blog->getThumbnail(),
                'oldid' => $id
            ]);

            echo $query->rowCount() . " record(s) UPDATED successfully <br>";
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage(); 
        }
    }

    /**
     * Get a blog post by ID
     * @param int $id The ID of the blog post to get
     * @return array The blog post data
     */
    function getPost($id)
    {
        $sql = "SELECT * FROM blog WHERE id = :id";
        $db = config::getConnexion();
        try {
            $query = $db->prepare($sql);
            $query->execute(['id' => $id]);

            $post = $query->fetch();
            return $post;
        } catch (Exception $e) {
            die('Error: ' . $e->getMessage());
        }
    }

    /**
     * Get all blog post IDs
     * @return array List of blog post IDs
     */
    public function getAllPostIds()
    {
        $sql = "SELECT id FROM blog";
        $db = config::getConnexion();
        try {
            $result = $db->query($sql);
            $ids = [];
            foreach ($result as $row) {
                $ids[] = $row['id'];
            }
            return $ids;
        } catch (Exception $e) {
            die('error: ' . $e->getMessage());
        }
    }

    /**
     * Get blog posts by category
     * @param string $category The category to filter by
     * @return array List of blog posts in the specified category
     */
    public function getPostsByCategory($category)
    {
        $sql = "SELECT * FROM blog WHERE categorie = :categorie";
        $db = config::getConnexion();
        try {
            $query = $db->prepare($sql);
            $query->execute(['categorie' => $category]);
            
            return $query->fetchAll();
        } catch (Exception $e) {
            die('error: ' . $e->getMessage());
        }
    }

    /**
     * Get blog posts by author
     * @param string $author The author to filter by
     * @return array List of blog posts by the specified author
     */
    public function getPostsByAuthor($author)
    {
        $sql = "SELECT * FROM blog WHERE auteur = :auteur";
        $db = config::getConnexion();
        try {
            $query = $db->prepare($sql);
            $query->execute(['auteur' => $author]);
            
            return $query->fetchAll();
        } catch (Exception $e) {
            die('error: ' . $e->getMessage());
        }
    }

    /**
     * Get published blog posts
     * @return array List of published blog posts
     */
    public function getPublishedPosts()
    {
        $sql = "SELECT * FROM blog WHERE statut = 'published'";
        $db = config::getConnexion();
        try {
            $result = $db->query($sql);
            return $result;
        } catch (Exception $e) {
            die('error: ' . $e->getMessage());
        }
    }
}
?>
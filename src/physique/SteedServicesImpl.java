/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package physique;

import entities.SteedEntity;
import entities.exceptions.NonexistentEntityException;
import interfaces.SteedService;
import java.util.List;
import javax.persistence.Query;

/**
 *
 * @author Oussama
 */
public class SteedServicesImpl extends JPABase implements SteedService{

    @Override
    public SteedEntity add(SteedEntity steed) throws Exception {
        try{
            this.open();
            this.em.persist(steed);
            this.transac.commit();
        } finally {
            if(this != null){
                this.close();
            }
        }
        return steed;
    }

    @Override
    public void update(SteedEntity steed) throws Exception {
        try{
            this.open();
            this.em.merge(steed);
            this.transac.commit();
        } catch (Exception ex) {
            String msg = ex.getLocalizedMessage();
            if (msg == null || msg.length() == 0) {
                long id = steed.getId();
                if (getById(id) == null) {
                    throw new NonexistentEntityException("The ContainerEntity with id " + id + " no longer exists.");
                }
            }
            throw ex;
        } finally {
            this.close();
        }
    }

    @Override
    public void delete(SteedEntity steed) throws Exception {
        try{
            this.open();
            steed = this.em.merge(steed);
            this.em.remove(steed);
            this.transac.commit();
        } finally {
            this.close();
        }
    }

    @Override
    public SteedEntity getById(long id) throws Exception {
        try {
            return this.em.find(SteedEntity.class, id);
        } finally {
            em.close();
        }
    }

    @Override
    public SteedEntity getBymail(String mail) throws Exception {
        List<SteedEntity> steeds;
        SteedEntity steed = null;
        try{
            this.open();
            Query query = em.createQuery("SELECT s FROM SteedEntity s WHERE (s.mail) = :mail");
            query.setParameter("mail", mail);
            steeds = query.getResultList();
            if(!steeds.isEmpty()){
                steed = steeds.get(0);
            }
        } finally {
            this.close();
        }
        return steed;
    }

    @Override
    public SteedEntity getByName(String name, String firstname) throws Exception {
        List<SteedEntity> steeds;
        SteedEntity steed = null;
        try{
            this.open();
            Query query = em.createQuery("SELECT s FROM SteedEntity s WHERE (s.name) = :name AND (s.firstname) = :firstname");
            query.setParameter("name", name);
            query.setParameter("firstname", firstname);
            steeds = query.getResultList();
            if(!steeds.isEmpty()){
                steed = steeds.get(0);
            }
        } finally {
            this.close();
        }
        return steed;
    }

    @Override
    public List<SteedEntity> getAll() throws Exception {
        List<SteedEntity> steeds;
        try{
            this.open();
            Query query = em.createQuery("SELECT s FROM SteedEntity s");
            steeds = query.getResultList();
        } finally {
            this.close();
        }
        return steeds;
    }
    
}

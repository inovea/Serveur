/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package physique;

import entities.ContainerEntity;
import entities.exceptions.NonexistentEntityException;
import interfaces.ContainerService;
import java.util.List;
import javax.persistence.Query;

/**
 *
 * @author Oussama
 */
public class ContainerServicesImpl extends JPABase implements ContainerService{

    @Override
    public ContainerEntity add(ContainerEntity container) throws Exception {
        try{
            this.open();
            this.em.persist(container);
            this.transac.commit();
        } finally {
            if(this != null){
                this.close();
            }
        }
        return container;  
    }

    @Override
    public void update(ContainerEntity container) throws Exception {
        try{
            this.open();
            this.em.merge(container);
            this.transac.commit();
        } catch (Exception ex) {
            String msg = ex.getLocalizedMessage();
            if (msg == null || msg.length() == 0) {
                long id = container.getId();
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
    public void delete(ContainerEntity container) throws Exception {
        try{
            this.open();
            container = this.em.merge(container);
            this.em.remove(container);
            this.transac.commit();
        } finally {
            this.close();
        }
    }

    @Override
    public ContainerEntity getById(long id) throws Exception {
        try {
            return this.em.find(ContainerEntity.class, id);
        } finally {
            em.close();
        }
    }

    @Override
    public ContainerEntity getByCoordinates(String lat, String lng) throws Exception {
        List<ContainerEntity> containers;
        ContainerEntity container = null;
        try{
            this.open();
            Query query = em.createQuery("SELECT c FROM ContainerEntity c WHERE (c.lat) = :lat AND (c.lng) = :lng");
            query.setParameter("lat", lat);
            query.setParameter("lng", lng);
            containers = query.getResultList();
            if(!containers.isEmpty()){
                container = containers.get(0);
            }
        } finally {
            this.close();
        }
        return container;
    }

    @Override
    public ContainerEntity getByAddress(String address) throws Exception {
        throw new UnsupportedOperationException("Not supported yet."); //To change body of generated methods, choose Tools | Templates.
    }

    @Override
    public List<ContainerEntity> getByState(boolean state) throws Exception {
        List<ContainerEntity> containers;
        try{
            this.open();
            Query query = em.createQuery("SELECT c FROM ContainerEntity c WHERE (c.state) = :state");
            query.setParameter("state", state);
            containers = query.getResultList();
        } finally {
            this.close();
        }
        return containers;
    }

    @Override
    public void setStateFull(long id) throws Exception {
        ContainerEntity container = this.getById(id);
        container.setState(true);
        this.update(container);
    }

    @Override
    public List<ContainerEntity> getAll() throws Exception {
        List<ContainerEntity> containers;
        try{
            this.open();
            Query query = em.createQuery("SELECT c FROM ContainerEntity c");
            containers = query.getResultList();
        } finally {
            this.close();
        }
        return containers;
    }
    
}

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package physique;

import entities.AlertEntity;
import entities.exceptions.NonexistentEntityException;
import interfaces.AlertService;
import java.util.List;
import javax.persistence.Query;

/**
 *
 * @author Oussama
 */
public class AlertServicesImpl extends JPABase implements AlertService{

    @Override
    public AlertEntity add(AlertEntity alert) throws Exception {
        try{
            this.open();
            this.em.persist(alert);
            this.transac.commit();
        } finally {
            if(this != null){
                this.close();
            }
        }
        return alert;     
    }

    @Override
    public void update(AlertEntity alert) throws Exception {
        try{
            this.open();
            this.em.merge(alert);
            this.transac.commit();
        } catch (Exception ex) {
            String msg = ex.getLocalizedMessage();
            if (msg == null || msg.length() == 0) {
                long id = alert.getId();
                if (getById(id) == null) {
                    throw new NonexistentEntityException("The alertEntity with id " + id + " no longer exists.");
                }
            }
            throw ex;
        } finally {
            this.close();
        }
    }

    @Override
    public void delete(AlertEntity alert) throws Exception {
        try{
            this.open();
            alert = this.em.merge(alert);
            this.em.remove(alert);
            this.transac.commit();
        } finally {
            this.close();
        }
    }

    @Override
    public AlertEntity getById(long id) throws Exception {
        try {
            return this.em.find(AlertEntity.class, id);
        } finally {
            em.close();
        }
    }

    @Override
    public List<AlertEntity> getByState(boolean state) throws Exception {
        List<AlertEntity> alerts;
        try{
            this.open();
            Query query = em.createQuery("SELECT a FROM AlertEntity a WHERE (a.state) = :state");
            query.setParameter("state", state);
            alerts = query.getResultList();
        } finally {
            this.close();
        }
        return alerts;
    }

    @Override
    public List<AlertEntity> getAll() throws Exception {
        List<AlertEntity> alerts;
        try{
            this.open();
            Query query = em.createQuery("SELECT a FROM AlertEntity a");
            alerts = query.getResultList();
        } finally {
            this.close();
        }
        return alerts;
    }
    
}

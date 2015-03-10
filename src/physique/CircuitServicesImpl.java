/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package physique;

import entities.CircuitEntity;
import entities.exceptions.NonexistentEntityException;
import interfaces.CircuitService;
import java.util.List;
import javax.persistence.Query;

/**
 *
 * @author Oussama
 */
public class CircuitServicesImpl extends JPABase implements CircuitService{

    @Override
    public CircuitEntity add(CircuitEntity circuit) throws Exception {
        try{
            this.open();
            this.em.persist(circuit);
            this.transac.commit();
        } finally {
            if(this != null){
                this.close();
            }
        }
        return circuit;
    }

    @Override
    public void update(CircuitEntity circuit) throws Exception {
        try{
            this.open();
            this.em.merge(circuit);
            this.transac.commit();
        } catch (Exception ex) {
            String msg = ex.getLocalizedMessage();
            if (msg == null || msg.length() == 0) {
                long id = circuit.getId();
                if (getById(id) == null) {
                    throw new NonexistentEntityException("The CircuitEntity with id " + id + " no longer exists.");
                }
            }
            throw ex;
        } finally {
            this.close();
        }
    }

    @Override
    public void delete(CircuitEntity circuit) throws Exception {
        try{
            this.open();
            circuit = this.em.merge(circuit);
            this.em.remove(circuit);
            this.transac.commit();
        } finally {
            this.close();
        }
    }

    @Override
    public CircuitEntity getById(long id) throws Exception {
        try {
            return this.em.find(CircuitEntity.class, id);
        } finally {
            em.close();
        }
    }

    @Override
    public List<CircuitEntity> getByState(boolean state) throws Exception {
        List<CircuitEntity> circuits;
        try{
            this.open();
            Query query = em.createQuery("SELECT c FROM CircuitEntity c WHERE (c.state) = :state");
            query.setParameter("state", state);
            circuits = query.getResultList();
        } finally {
            this.close();
        }
        return circuits;
    }

    @Override
    public void setState(long id, boolean state) throws Exception {
        CircuitEntity circuit = this.getById(id);
        circuit.setState(true);
        this.update(circuit);
    }

    @Override
    public List<CircuitEntity> getAll() throws Exception {
        List<CircuitEntity> circuits;
        try{
            this.open();
            Query query = em.createQuery("SELECT c FROM CircuitEntity c");
            circuits = query.getResultList();
        } finally {
            this.close();
        }
        return circuits;
    }
    
}

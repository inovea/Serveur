/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package interfaces;

import entities.Circuit;
import java.util.List;

/**
 *
 * @author Oussama
 */
public interface CircuitService {
    public Circuit add(Circuit circuit) throws Exception;
    public void update(Circuit circuit) throws Exception;
    public void delete(Circuit circuit) throws Exception;
    
    public Circuit getById(long id) throws Exception;
    public List<Circuit> getByState(boolean state) throws Exception;
    public void setState(long id, boolean state) throws Exception;
    public List<Circuit> getAll() throws Exception;
}

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package interfaces;

import entities.Steed;
import java.util.List;

/**
 *
 * @author Oussama
 */
public interface SteedService {
    public Steed add(Steed steed) throws Exception;
    public void update(Steed steed) throws Exception;
    public void delete(Steed steed) throws Exception;
    
    public Steed getById(long id) throws Exception;
    public Steed getBymail(String mail) throws Exception;
    public Steed getByName(String name, String firstname) throws Exception;
    public List<Steed> getAll() throws Exception;
}

#include<bits/stdc++.h>
using namespace std;
# define INF 9999999

typedef pair<int, int> edgeWeightPair;

/*
test case 
1
5 5
1 2 2
2 3 4
3 4 5
4 5 1
1 4 7
3
4 20
5 21
3 5
*/
/*
output
6
5
0

*/

class Graph
{
    int V;
    list<edgeWeightPair> *adj;
    vector<int> dist;

public:
    Graph(int V) 
    {
        this->V = V;
        adj = new list<edgeWeightPair> [V];
        vector<int> temp(V,INF);
        dist = temp;
    }
    void addEdge(int u, int v, int w)
    {
        adj[u].push_back(make_pair(v, w));
        adj[v].push_back(make_pair(u, w));
    }
    void Dijkstra(int src)
    {
        priority_queue< edgeWeightPair, vector <edgeWeightPair> , greater<edgeWeightPair> > pq;
        pq.push(make_pair(0, src));
        dist[src] = 0;
        while (!pq.empty()) 
        {
            int u = pq.top().second; 
            pq.pop();
            list< pair<int, int> >::iterator i;
            for (i = adj[u].begin(); i != adj[u].end(); ++i) 
            {
                int v = (*i).first;
                int weight = (*i).second;
                if (dist[v] > dist[u] + weight) 
                {
                    dist[v] = dist[u] + weight; 
                    pq.push(make_pair(dist[v], v)); 
                }
            }
        }
    
    }
    int minimumCost(int x){
         return dist[x];
    }
};

int main(){
    int t;
    cin>>t;

    while(t--){
        int n,m;
        cin>>n>>m;
        Graph g(n);
        int x,y,c;
        for(int i=0;i<m;i++){
    

           cin>>x>>y>>c;
           
           //In graph i consider vertex name form 0 that mean 
           //for the follwing input every vertex name i consider v-1
           //but answer will be always currect
           //becouse in each query i aslo dicree vertex value v = v-1;

           g.addEdge(x-1,y-1,c);
        }
        //In the question tell srcvertex 1 is sourse 
        //for the above reason i consider srcvertex = srcvertex -1 ;
                                          // srcvertex = 0
        g.Dijkstra(0);


        int q;
        cin>>q;
        while(q--){
            int a,k;
            cin>>a>>k;
            //in query i consider v = v-1. for above reason
            int cost = g.minimumCost(a-1);
            cost*=2;
            if(cost>=k)cout<<0<<endl;
            else{
               cout<<k-cost<<endl;
            }

        }

    }
}